<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequesValidate;
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
    public function store(ProductsRequesValidate $request)
    {
        $data = $request->all();
        $properties = [];

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

        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
                echo $property['value'];
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }
        }

        if($request->base_price != NULL) {
            if($request->currency == 'RUB') {
                $data['price'] = $request->base_price;
            } else {
                $currency = Currency::find($request->currency);
                $data['price'] = $request->base_price * $currency->Nominal * $currency->value;
            }
        } else {
            $data['base_price'] = 0;
            $data['price'] = 0;
        }

        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);

        $product = Product::create($data);
        if ($request->isMethod('post') && $request->file('image')) {
            foreach ($request->file('image') as $image) {
                $path_to = '/upload/images/'.Str::lower(Str::random(2));
                $FileName =  time().'_'.Str::lower(Str::random(2)).'.'.$image->getClientOriginalExtension();
                $BigFileName =  'big_'.$FileName;
                $SmallFileName =  'small_'.$FileName;
                $image->storeAs('public'.$path_to, $BigFileName);
                $image->storeAs('public'.$path_to, $SmallFileName);
                Image::make(storage_path('app/public'.$path_to.'/'.$SmallFileName))->fit(100)->save();
                \App\Models\Image::create([
                    'product_id' => $product->id,
                    'img' => 'storage'.$path_to.'/'.$BigFileName,
                    'thumbnail' => 'storage'.$path_to.'/'.$SmallFileName,
                ]);
            }
        }
        return redirect()->route('catalog_list', $data['category_id'] )->with('success', 'Новый товар созздан');
    }


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

    public function list($id=NULL)
    {
        $h1 = 'Редактирование товаров каталога';
        $categories = ($id) ?Category::descendantsAndSelf($id)->toTree() :  Category::get()->toTree();
        return view('admin.products_show', compact('h1', 'categories', 'id'));
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
