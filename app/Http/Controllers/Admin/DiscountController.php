<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = 'Список скидок на товары коталога ';
        $discounts = Discount::orderBy('sort')->paginate(20);
        return view('admin.discounts_index', compact('h1', 'discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = 'Создание скидки на товары коталога ';
        return view('admin.discounts_create', compact('h1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Поле "Наименование скидки" обязательно для заполнения',
            'value.required' => 'Укажите значение размера скидки',
            'value.integer' => 'Размер скидки должен быть целым числом',
        ];
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required|integer',
        ],$messages);
        $discount = new Discount();
        $discount->name = $request->name;
        $discount->type = $request->type;
        $discount->kind = $request->kind;
        $discount->value = $request->value;
        $discount->active = $request->has('active') ? 1 : 0;
        $discount->sort = $request->sort;
        $discount->categories = ($request->kind=='category') ? json_encode($request->productsID) : NULL;
        $discount->save();
        switch ($request->kind) {
            case 'goods':
                $products = Product::find($request->productsID);
                $discount->product()->attach($products);
                return redirect()->route('discounts.index')->with('success', 'Скидка '.$request->name.' создана');
                break;
            case 'category':
                $arrProductsId = [];
                foreach ($request->productsID as $item){
                    $DataCategories = Category::descendantsAndSelf($item);
                    $arrProductsId = array_merge($arrProductsId, Product::whereIn('category_id', $DataCategories->pluck('id'))->select('id')->get()->toArray());
                }
                $productsID =array_unique($arrProductsId, SORT_REGULAR);
                $discount->product()->attach(Product::find($productsID));
                return redirect()->route('discounts.index')->with('success', 'Скидка '.$request->name.' создана');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $h1 = 'Редактирование скидки';
        $discount = Discount::with('product')->find($id);
        switch ($discount->kind) {
            case 'goods':
                $categories = false;
                $products = $discount->product;
                return view('admin.discounts_update', compact('h1', 'discount', 'products', 'categories'));
                break;
            case 'category':
                $products = [];
                $categories = Category::select('id', 'name')->find(json_decode($discount->categories, true));
                return view('admin.discounts_update', compact('h1', 'discount', 'products', 'categories'));
                break;
            }
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

        $messages = [
            'name.required' => 'Поле "Наименование скидки" обязательно для заполнения',
            'value.required' => 'Укажите значение размера скидки',
            'value.integer' => 'Размер скидки должен быть целым числом',
        ];
        $this->validate($request, [
            'name' => 'required',
            'value' => 'required|integer',
        ],$messages);
        $data = $request->all();
        $data['active']=$request->has('active') ? 1 : 0;
        $data['categories'] = ($request->kind=='category') ? json_encode($request->productsID) : NULL;
        $discount = Discount::find($id);
        switch ($request->kind) {
            case 'goods':
                $productsID = array_map('intval', $request->productsID);
                $discount->product()->sync($productsID);
            case 'category':
                $arrProductsId = [];
                foreach ($request->productsID as $item){
                    $DataCategories = Category::descendantsAndSelf($item);
                    $arrProductsId = array_merge($arrProductsId, Product::whereIn('category_id', $DataCategories->pluck('id'))->select('id')->get()->toArray());
                }
                $productsID =array_unique($arrProductsId, SORT_REGULAR);
                $discount->product()->sync(Arr::flatten($productsID));
        }
        $discount->update($data);
        return redirect()->route('discounts.index')->with('success', 'Данные скидки обновлены');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->product()->sync([]);
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Скидка удалена');
    }

    public function goods(Request $request)
    {
        $kind = $request->kind;
        $DataCategories = Category::get();
        $categories = $DataCategories->toTree();
        switch ($kind) {
            case 'goods':
                $products = Product::orderBy('sort', 'asc')->paginate(2);
                $categoryId = 0;
                $products->withPath('/admin/discounts_paginate');
                return view('admin.ajax.products_show', compact('categoryId','categories', 'products'));
                break;
            case 'category':
                return view('admin.ajax.categories_show', compact('categories', ));
                break;
        }
    }

    public function choice(Request $request){
        $id = $request->id;
        $DataCategories = Category::descendantsAndSelf($id);
        $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(2);
        $categoryId = $request->id;
        $products->withPath('/admin/discounts_paginate');
        return view('admin.ajax.products_choice', compact('products', 'categoryId'));
    }

    public function paginate(Request $request){
        $categoryId = $request->category;
        if($categoryId == 0){
            $products = Product::paginate(2);
        }else{
            $DataCategories = Category::descendantsAndSelf($categoryId);
            $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(2);
        }
        $products->withPath('/admin/discounts_paginate');
        return view('admin.ajax.products_choice', compact('products', 'categoryId'));
    }

    public function goods_update(Request $request){
        $DataCategories = Category::get();
        $categories = $DataCategories->toTree();
        $items_id = $request->items_id;
        switch ($request->kind) {
            case 'goods':
                $products = Product::orderBy('sort', 'asc')->paginate(2);
                $categoryId = 0;
                $products->withPath('/admin/discounts_paginate_update');
                return view('admin.ajax.products_update', compact('categoryId','categories', 'products', 'items_id'));
                break;
            case 'category':
                return view('admin.ajax.categories_update', compact('categories', 'items_id'));
                break;
        }

    }

    public function choice_update(Request $request){
        $id = $request->id;
        $items_id = $request->itemsId;
        $DataCategories = Category::descendantsAndSelf($id);
        $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(2);
        $categoryId = $request->id;
        $products->withPath('/admin/discounts_paginate_update');
        return view('admin.ajax.products_choice_update', compact('products', 'categoryId', 'items_id'));
    }

    public function paginate_update(Request $request){
        $categoryId = $request->category;
        $items_id = $request->itemsId;
        if($categoryId == 0){
            $products = Product::orderBy('sort')->paginate(2);
        }else{
            $DataCategories = Category::descendantsAndSelf($categoryId);
            $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(2);
        }
        $products->withPath('/admin/discounts_paginate_update');
        return view('admin.ajax.products_choice_update', compact('products', 'categoryId', 'items_id'));
    }

}
