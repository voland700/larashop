<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use Illuminate\Http\Request;

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
        //
    }


    public function show($id)
    {
        $h1 = 'Редактирование товаров каталога';

        //$categories = Category::all($id);

        $categories = Category::descendantsAndSelf($id)->toTree();
        //return view('admin.products_show', compact('h1', 'categories', 'id'));

        dd($currency);

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
        //$category = $categories->find($id);
        $h1='Создть новый товар';
        $category_id = $id;
        return view('admin.products_create', compact('h1', 'categories', 'category_id', 'currency'));
        //dd($currency);
    }



}
