<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        return view('admin.discounts_index', compact('h1'));
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
        //
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


    public function goods(Request $request)
    {

        $type = $request->type;
        switch ($type) {
            case 'goods':
                //$DataCategories = ($id) ? Category::descendantsAndSelf($id) :  Category::get();
                $DataCategories = Category::get();
                $categories = $DataCategories->toTree();
                $products = Product::orderBy('sort', 'asc')->paginate(2);
                $categoryId = 0;
                $products->withPath('/admin/discounts_paginate');
                return view('admin.ajax.products_show', compact('categoryId','categories', 'products'));






                break;
            case 'category':
                echo "Вывод списка категорий.";
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
        $DataCategories = Category::descendantsAndSelf($categoryId);
        $products = Product::whereIn('category_id', $DataCategories->pluck('id'))->orderBy('sort')->paginate(2);
        $products->withPath('/admin/discounts_paginate');
        return view('admin.ajax.products_choice', compact('products', 'categoryId'));
    }











}
