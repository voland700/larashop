<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequesValidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = "Производители";
        $brands = Brand::all()->sortBy('sort');
        return view('admin.brands_index', compact('h1', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = 'Добавить нового производителя';
        return view('admin.brands_create', compact('h1' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequesValidate $request)
    {
        $brand = new Brand($request->all());
        $brand->active=$request->has('active') ? 1 : 0;
        $brand->slider=$request->has('slider') ? 1 : 0;

        if($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $brand->img = 'storage'.$path_to.'/'.$fileName;
        } else {
            $brand->img = 'img/general/no_banner.jpg';
        }
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Производитель создан');
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
        $h1 = 'Редактирование данных производителя';
        $brand= Brand::find($id);
        return view('admin.brands_update', compact('h1',  'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequesValidate $request, $id)
    {
        $brand = Brand::find($id);
        $data = $request->all();
        $data['active']=$request->has('active') ? 1 : 0;
        $data['slider']=$request->has('slider') ? 1 : 0;
        if ($request->hasFile('img')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $brand->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $brand->img));
            }
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['img'] = 'storage'.$path_to.'/'.$fileName;
        }
        $brand->update($data);
        return redirect()->route('brands.index')->with('success', 'Данные производителя обнавлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $brand->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $brand->img));
        }
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'данные производителя удалёны');
    }

    public function brandImgRemove(Request $request)
    {
        $brand = Brand::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $brand->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $brand->img));
        }
        $brand->img = 'img/general/no_banner.jpg';
        $brand->save();
    }

}
