<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $properties = [];

        $messages = [
            'name.required' => 'Поле "Название товара" обязательно для заполнения',
            'slug.required' => 'Поле "Символьный код" обязательно для заполнения',
            'slug.unique' => 'Данные в поле "Символьный код" должны быть уникальными',
            'img.image' => 'Основное изображение - должно быть файлом c изображением',
            'img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения не должен превышать 2 мб.',
            'prev_img.image' => 'Основное изображение - должно быть файлом c изображением',
            'prev_img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'prev_img.size' => 'Размер изображения не должен превышать 2 мб.',
            'image.image' => 'Доплнительные изображения - должны быть файлами изображений',
            'image.mimes' => 'Фалы оплнительными изображениями должны иметь расширение: jpeg,jpg,bmp,png',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
        ];
        $this->validate($request, [
            'name' => 'required',
            'slug'=>'required|unique:categories',
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'prev_img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'prev_img.size' => '2048|nullable',
            'image' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'image.size' => '2048|nullable',
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

        if ($request->isMethod('post') && $request->file('image')) {
            /*
            foreach ($request->file('image') as $item) {
                $images = new Images();



                $imgName = $item->store('images', 'public');
                $images->pechnik_id = $pechnik->id;
                $images->img = 'storage/'.$imgName;
                $images->save();

                //Image::create
            }
            */
        }




        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
                echo $property['value'];
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }

        }
        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);




        dd($properties);


    }


    public function show($id)
    {
        $h1 = 'Редактирование товаров каталога';

        //$categories = Category::all($id);

        $categories = Category::descendantsAndSelf($id)->toTree();
        return view('admin.products_show', compact('h1', 'categories', 'id'));

        //dd($currency);

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

    public function make($id=NULL)
    {
        $categories = Category::all()->toTree();
        $currency = Currency::select('currency', 'Name')->get();
        $attributes = Attribute::all()->sortBy('sort');

        $h1='Создть новый товар';
        $category_id = $id;
        return view('admin.products_create', compact('h1', 'categories', 'category_id', 'currency', 'attributes'));
        //dd($attributes);
    }



}
