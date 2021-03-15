<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequestValidate;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $blog = new Blog();
        $data = $request->all();
        $files = Storage::disk('temp')->files();
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





        if(!empty($files)){
            foreach ($files as $file){

                //$image = Image::make(Storage::disk('temp')->path($file));
                //$thumbnail = Image::make(Storage::disk('temp')->path($file));
                $FilePath = '/upload/images/'.getfolderName();
                $FileName = time().'_'.Str::lower(Str::random(2)).''.'_gallery_';

                Storage::disk('public')->copy(Storage::disk('temp')->path($file), $FileName.'big.jpg');



                //$data['image'] = Storage::disk('public')->putFileAs($FilePath, $image, $FileName.'big.jpg');





               //Storage::disk('public')->storeAs($FilePath.'big.jpg');
               //Storage::disk('public')->storeAs($FilePath.'small.jpg');


               //$image->save($FilePath.'big.jpg');
                /*
               $thumbnail->resize(null, 250, function ($constraint) {
                   $constraint->aspectRatio();
                   })->save($FilePath.'small.jpg');
                */

                //$data['image'] = $FilePath.'big.jpg';
            }
         //Storage::disk('temp')->delete();



        }

        //$blog = new Blog($data);


        //$temp = Storage::disk('temp')->get('1.jpg');

        //$path = Storage::disk('temp')->path('1.jpg');



        dd($data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload(Request $request)
    {

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $path = Storage::disk('temp')->putFileAs('/', $image,$imageName);

        return response()->json(['success'=>$path]);
    }

    public function remove(Request $request)
    {
        $filename = $request->name;
        if (Storage::disk('temp')->exists($filename)){
            Storage::disk('temp')->delete($filename);
        }
        return response()->json(['success'=>'Файл удален']);
    }


}
