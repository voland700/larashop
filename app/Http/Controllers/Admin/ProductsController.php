<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequesValidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

use Kalnoy\Nestedset\NodeTrait;

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

    public function edit($id)
    {
        $product = Product::with('image')->find($id);
        $h1 = 'Редактирование: '.$product->name;
        $categories = Category::all()->toTree();
        $currency = Currency::select('currency', 'Name')->get();
        $attributes = Attribute::all()->sortBy('sort');
        $properties = $product->properties;
        if(!empty($properties) && is_array($properties)) {

            foreach($attributes as $item) {
                if(array_key_exists($item->id, $properties)){
                    $item['value'] = $properties[$item->id]['value'];
                }else {
                    $item['value'] = null;
                }
            }
        }
        return view('admin.products_update', compact('h1', 'product', 'categories', 'currency', 'attributes'));

    }

    public function update(ProductsRequesValidate $request, $id)
    {
        $product = Product::find($id);
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
        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
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
        if ($request->isMethod('PUT') && $request->file('image')) {
            foreach ($request->file('image') as $image) {
                $path_to = '/upload/images/'.Str::lower(Str::random(2));
                $FileName =  time().'_'.Str::lower(Str::random(2)).'.'.$image->getClientOriginalExtension();
                $BigFileName =  'big_'.$FileName;
                $SmallFileName =  'small_'.$FileName;
                $image->storeAs('public'.$path_to, $BigFileName);
                $image->storeAs('public'.$path_to, $SmallFileName);
                Image::make(storage_path('app/public'.$path_to.'/'.$SmallFileName))->fit(100)->save();
                \App\Models\Image::create([
                    'product_id' => $id,
                    'img' => 'storage'.$path_to.'/'.$BigFileName,
                    'thumbnail' => 'storage'.$path_to.'/'.$SmallFileName,
                ]);
            }
        }
        $product->update($data);
        return redirect()->route('catalog_list', $data['category_id'] )->with('success', 'данные товара изменены');

        //dd($data);
    }

    public function destroy($id)    {
        //
    }

    public function list($id=NULL)
    {
        $h1 = 'Редактирование товаров каталога';
        $DataCategories = ($id) ? Category::descendantsAndSelf($id) :  Category::get();
        $categories = $DataCategories->toTree();

        //$products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(20);
        if($id) {
            $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(20);
        } else {
            $products = Product::orderBy('sort', 'asc')->paginate(20);
        }





        return view('admin.products_show', compact('h1', 'categories', 'products','id'));
        //dd($DataCategories);
    }


    public function make($id=NULL)
    {
        $categories = Category::all()->toTree();
        $currency = Currency::select('currency', 'Name')->get();
        $attributes = Attribute::all()->sortBy('sort');

        $h1='Создть новый товар';
        $category_id = $id;
        return view('admin.products_create', compact('h1', 'categories', 'category_id', 'currency', 'attributes'));
    }

    public  function delete($id, $category=NULL)
    {
        $product = Product::with('image')->find($id);
        $images = $product->image;
        if (Storage::disk('public')->exists(str_replace('storage', '', $product->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $product->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $product->prev_img))){
            Storage::disk('public')->delete(str_replace('storage', '', $product->prev_img));
        }
        if (!$images->isEmpty()){
            foreach ($images as $image){
                if (Storage::disk('public')->exists(str_replace('storage', '', $image->img))){
                    Storage::disk('public')->delete(str_replace('storage', '', $image->img));
                }
                if (Storage::disk('public')->exists(str_replace('storage', '', $image->thumbnail))){
                    Storage::disk('public')->delete(str_replace('storage', '', $image->thumbnail));
                }
            }
            \App\Models\Image::destroy($images->pluck('id'));
        }
        $product->delete();
        return redirect()->route('catalog_list', $category )->with('success', 'Данные товара удалены');
    }









}
