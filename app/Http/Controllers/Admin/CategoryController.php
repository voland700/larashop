<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
//use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get()->toTree();
        $h1 = 'Редактирование категорй каталога';
        return view('admin.categories_index', compact('categories', 'h1'));
    }

    public function create()
    {
        $categories = Category::get()->toTree();
        $h1 = 'Создать новую категорию';
        return view('admin.categories_create', compact('categories','h1' ));
    }

    public function store(Request $request)
    {
        $category=new Category($request->all());
        $messages = [
            'name.required' => 'Поле "Наименование категории" обязательно для заполнения',
            'slug.required' => 'Поле "ЧПУ категории" обязательно для заполнения',
            'slug.unique' => 'Данные в поле "ЧПУ категории" должны быть уникальными',
            'img.image' => 'Фото - должно быть файлом c изображением',
            'img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения не должен превышать 2 мб.',
            'prev_img.image' => 'Фото - должно быть файлом c изображением',
            'prev_img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'prev_img.size' => 'Размер изображения не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
        ];
        $this->validate($request, [
            'name' => 'required',
            'slug'=>'required|unique:categories',
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'prev_img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'prev_img.size' => '2048|nullable',
            'sort' => 'integer|nullable',
        ],$messages);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $image->storeAs('public'.$path_to, $fileName);
            $category->img = 'storage'.$path_to.'/'.$fileName;
        }

        if ($request->hasFile('prev_img')) {
            $fileName =  time().'_prev_'.Str::lower(Str::random(2)).'.'.$request->file('prev_img')->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $thumbnail = $request->file('prev_img');
            $thumbnail->storeAs('public'.$path_to, $fileName);
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            $category->prev_img = 'storage'.$path_to.'/'.$fileName;
        }

        if($request->img && !$request->prev_img){
            $fileName =  time().'_prev_'.Str::lower(Str::random(2)).'.'.$request->file('img')->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $thumbnail = $request->file('img');
            $thumbnail->storeAs('public'.$path_to, $fileName);
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            $category->prev_img = 'storage'.$path_to.'/'.$fileName;
        }

        $category->save();
        return redirect()->route('categories.index')->with('success', 'Новая категория создана');
        //dd($category);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::get()->toTree();
        $h1 = 'Редактирование данных категрии каталога';
        return view('admin.categories_update', compact('categories', 'category', 'h1', 'id'));

        //dd($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $data = $request->all();
        $messages = [
            'name.required' => 'Поле "Наименование категории" обязательно для заполнения',
            'slug.required' => 'Поле "ЧПУ категории" обязательно для заполнения',
            'slug.unique' => 'Данные в поле "ЧПУ категории" должны быть уникальными',
            'img.image' => 'Фото - должно быть файлом c изображением',
            'img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения не должен превышать 2 мб.',
            'prev_img.image' => 'Фото - должно быть файлом c изображением',
            'prev_img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'prev_img.size' => 'Размер изображения не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
        ];

        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'prev_img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'prev_img.size' => '2048|nullable',
            'sort' => 'integer|nullable',
        ],$messages);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $image->storeAs('public'.$path_to, $fileName);
            $data['img'] = 'storage'.$path_to.'/'.$fileName;
        }

        if ($request->hasFile('prev_img')) {
            $fileName =  time().'_prev_'.Str::lower(Str::random(2)).'.'.$request->file('prev_img')->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $thumbnail = $request->file('prev_img');
            $thumbnail->storeAs('public'.$path_to, $fileName);
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            $data['prev_img'] = 'storage'.$path_to.'/'.$fileName;
        }

        if($request->img && !$request->prev_img){
            $fileName =  time().'_prev_'.Str::lower(Str::random(2)).'.'.$request->file('img')->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $thumbnail = $request->file('img');
            $thumbnail->storeAs('public'.$path_to, $fileName);
            Image::make(storage_path('app/public'.$path_to.'/'.$fileName))->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            $data['prev_img'] = 'storage'.$path_to.'/'.$fileName;
        }


        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = $request->slug;
        $category->active = $request->active;
        $category->sort = $request->sort ?? 500;
        $category->h1 = $request->h1;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;
        $category::fixTree();
        $category->update();
        return redirect()->route('categories.index')->with('success', 'Категория изменена');

        //dd($category->slug);
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
}
