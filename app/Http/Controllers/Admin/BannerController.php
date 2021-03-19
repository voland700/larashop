<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = 'Редактирование баннеров слайдера';
        //$sliders = Slider::all()->sortBy('sort');
        $banners = Banner::all()->sortBy('sort');
        return view('admin.banners_index', compact('h1', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1='Создание нового баннера';
        return view('admin.banners_create', compact('h1' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner($request->all());
        $banner->active = $request->has('active') ? 1 : 0;
        $messages = [
            'name.required' => 'Поле "Название, заголовок баннера" обязательно для заполнения',
            'img.required' => 'Изобразение для баннера - обязательно',
            'img.image' => 'Картинка для баннера - должна быть файлом c изображением',
            'img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
        $this->validate($request, [
            'name' => 'required',
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'sort' => 'integer|nullable'
        ],$messages);
        if($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $banner->img = 'storage'.$path_to.'/'.$fileName;
        }
        $banner->save();
        return redirect()->route('banners.index')->with('success', 'Баннер создан');
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
        $h1 = 'Редактирование баннера слайдера';
        $banner = Banner::find($id);
        return view('admin.banners_update', compact('h1',  'banner'));
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
        $banner = Banner::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        if ($request->hasFile('img')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $banner->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $banner->img));
            }
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['img'] = 'storage'.$path_to.'/'.$fileName;
        }
        $banner->update($data);
        return redirect()->route('banners.index')->with('success', 'Баннер обнавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $banner->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $banner->img));
        }
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Баннер удалён');
    }
}
