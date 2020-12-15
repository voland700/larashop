<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $h1 = 'Редактирование категорй каталога';
        return view('admin.categories_index', compact('categories', 'h1'));
    }

    public function create()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
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
        $categories = Category::all();
        $messages = [
            'name.required' => 'Поле "Наименование категории" обязательно для заполнения',
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
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2000|nullable',
            'prev_img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'prev_img.size' => '2000|nullable',
            'sort' => 'integer|nullable',
        ],$messages);
        //link::create($request->all());

        dd(time());

        //return redirect()->route('admin.categories_index')->with('success', 'Ссылка на товар добавлена!');




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
}
