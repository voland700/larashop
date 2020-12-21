<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
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
            $category->img = $image->storeAs($path_to, $fileName);
        }

        if ($request->hasFile('prev_img')) {
            $fileName =  time().'_prev_'.Str::lower(Str::random(2)).'.'.$request->file('prev_img')->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $path = $request->file('prev_img')->storeAs($path_to, $fileName);
            Image::make(storage_path('app/'.$path))->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            $category->prev_img = $path;
        }

        if($request->img && !$request->prev_img){
            $fileName =  time().'_prev_'.Str::lower(Str::random(2)).'.'.$request->img->getClientOriginalExtension();
            $path_to = '/upload/images/'.Str::lower(Str::random(2));
            $path = $request->file('img')->storeAs($path_to, $fileName);
            Image::make(storage_path('app/'.$path))->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();
            $category->prev_img = $path;
        }
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = $request->slug;
        $category->active = $request->active;
        $category->sort = $request->sort ?? 500;
        $category->h1 = $request->h1;
        $category->meta_description = $request->meta_description;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Новая категория создана');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::get();
        $category = $categories->find($id);
        $categories=$categories->toTree();
        $h1 = 'Редактирование данных категрии каталога';
        //return view('admin.categories_update', compact('categories', 'category', 'h1'));

        dd($category);
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
