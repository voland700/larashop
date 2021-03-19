<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequestValidate;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Temp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = "Статьи, дополнительная информация";
        $blogs = Blog::orderBy('sort', 'asc')->paginate(20);
        return view('admin.blogs_index', compact('h1', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = 'Создание статьи для блога';
        return view('admin.blogs_create', compact('h1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequestValidate $request)
    {
        $blog = new Blog($request->all());
        $galleryFiles = Temp::get();
        $blog->active = $request->has('active') ? 1 : 0;
        if($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $blog->img= 'storage'.$path_to.'/'.$fileName;
        }
        if($request->hasFile('prev_img')) {
            $image = $request->file('prev_img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $blog->prev_img = 'storage'.$path_to.'/'.$fileName;
        }
        $blog->save();
        if(!$galleryFiles->isEmpty()){
            foreach ($galleryFiles as $gallery){
                Gallery::create([
                    'blog_id' => $blog->id,
                    'image' => $gallery->image,
                    'thumbnail' => $gallery->thumbnail,
                ]);
            }
            DB::delete('delete from temp_files');
        }
        return redirect()->route('blogs.index')->with('success', 'Статья создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $h1 = "Редактирование данных статьи";
        $blog = Blog::find($id);
        $galleries = Gallery::where('blog_id', $id)->get();
        return view('admin.blogs_update', compact('h1', 'blog', 'galleries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $galleryFiles = Temp::get();

        if($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['img']= 'storage'.$path_to.'/'.$fileName;
        }
        if($request->hasFile('prev_img')) {
            $image = $request->file('prev_img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['prev_img'] = 'storage'.$path_to.'/'.$fileName;
        }
        $blog->update($data);
        if(!$galleryFiles->isEmpty()){
            foreach ($galleryFiles as $gallery){
                Gallery::create([
                    'blog_id' => $blog->id,
                    'image' => $gallery->image,
                    'thumbnail' => $gallery->thumbnail,
                ]);
            }
            DB::delete('delete from temp_files');
        }
        return redirect()->route('blogs.index')->with('success', 'Статья обновлена');



        //dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::with('gallery')->find($id);

        if (Storage::disk('public')->exists(str_replace('storage', '', $blog->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $blog->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $blog->prev_img))){
            Storage::disk('public')->delete(str_replace('storage', '', $blog->prev_img));
        }
        if(!$blog->gallery->isEmpty()) {
            foreach ($blog->gallery as $gallery) {
                if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->image))) {
                    Storage::disk('public')->delete(str_replace('storage', '', $gallery->image));
                }
                if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->thumbnail))) {
                    Storage::disk('public')->delete(str_replace('storage', '', $gallery->thumbnail));
                }
            }
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Статья удалена');
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $thumbnail = $request->file('file');
            $original = $image->getClientOriginalName();
            $path = '/upload/images/' . getfolderName().'/';
            $FileName =    time() .'_gallery_';
            $FileNameImages = $FileName.'big' .'.'.$image->getClientOriginalExtension();
            $FileNameThumbnail = $FileName.'small' .'.'.$thumbnail->getClientOriginalExtension();
            $image->storeAs('public'.$path, $FileNameImages);
            $thumbnail->storeAs('public'.$path, $FileNameThumbnail);
            Image::make(storage_path('app/public'.$path.'/'.$FileNameThumbnail))->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
            $TempFile = new Temp();
            $TempFile->image = 'storage'.$path.$FileNameImages;
            $TempFile->thumbnail = 'storage'.$path.$FileNameThumbnail;
            $TempFile->original =$original;
            $TempFile->save();
            return response()->json(['success'=>'ok']);
        }
    }

    public function remove(Request $request)
    {
        $filename = $request->name;
        $TempFiles = Temp::where('original', $filename);
        foreach($TempFiles->get() as  $temp){
            if (Storage::disk('public')->exists(str_replace('storage', '', $temp->image))){
                Storage::disk('public')->delete(str_replace('storage', '', $temp->image));
            }
            if (Storage::disk('public')->exists(str_replace('storage', '', $temp->thumbnail))){
                Storage::disk('public')->delete(str_replace('storage', '', $temp->thumbnail));
            }
        }
        $TempFiles->delete();
        return response()->json(['success'=>'Файл удален']);
    }

    public function imagesRemove(Request $request)
    {
        $blog = Blog::find($request->id);
        $type = $request->type;
        $imageFile = $blog->$type;
        if (Storage::disk('public')->exists(str_replace('storage', '', $imageFile))){
            Storage::disk('public')->delete(str_replace('storage', '', $imageFile));
        }
        $blog->$type = null;
        $blog->save();
        return response()->json(['success'=>'Файлы удалены']);
    }

    public function galleryRemove(Request $request)
    {
        $gallery = Gallery::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->image))){
            Storage::disk('public')->delete(str_replace('storage', '', $gallery->image));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->thumbnail))){
            Storage::disk('public')->delete(str_replace('storage', '', $gallery->thumbnail));
        }
        $gallery->delete();
        return response()->json(['success'=>'Файл удален']);
    }

    public function galleryAllRemove(Request $request)
    {
        $galleries = Gallery::where('blog_id', $request->id)->get();
        if(!$galleries->isEmpty()){
            foreach ($galleries as $gallery){
                if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->image))){
                    Storage::disk('public')->delete(str_replace('storage', '', $gallery->image));
                }
                if (Storage::disk('public')->exists(str_replace('storage', '', $gallery->thumbnail))){
                    Storage::disk('public')->delete(str_replace('storage', '', $gallery->thumbnail));
                }
            }

        }
        DB::table('gallery')->where('blog_id', $request->id)->delete();
        return response()->json(['success'=>'Файлы удалены']);
    }

}
