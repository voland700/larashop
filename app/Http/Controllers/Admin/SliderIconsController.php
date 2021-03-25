<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderIconsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = "Список преимуществ слайдера";
        $icons = SliderIcon::all()->sortBy('sort');
        return view('admin.slidicons_index', compact('h1', 'icons'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = "Создать новое преимущество слайдера";
        return view('admin.slidicons_create', compact('h1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $icon = new SliderIcon($request->all());
        $icon->active = $request->has('active') ? 1 : 0;
        $messages = [
            'name.required' => 'Поле "Название, заголовок" обязательно для заполнения',
            'img.required' => 'Изобразение иконки - обязательно',
            'img.image' => 'Картинка иконки - должна быть файлом c изображением',
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
            $icon->img = 'storage'.$path_to.'/'.$fileName;
        }
        $icon->save();
        return redirect()->route('slider_icons.index')->with('success', 'Преимущество создано');
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
        $h1 = 'Редактирование преимуществ слайдера';
        $icon = SliderIcon::find($id);
        return view('admin.slidicons_update', compact('h1',  'icon'));
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
        $icon = SliderIcon::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        if ($request->hasFile('img')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $icon->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $icon->img));
            }
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['img'] = 'storage'.$path_to.'/'.$fileName;
        }
        $icon->update($data);
        return redirect()->route('slider_icons.index')->with('success', 'Данные преимущества обнавлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $icon = SliderIcon::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $icon->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $icon->img));
        }
        $icon->delete();
        return redirect()->route('slider_icons.index')->with('success', 'Данные преимущества удалёны');
    }

    public function remove(Request $request)
    {
        $icon = SliderIcon::find($request->id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $icon->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $icon->img));
        }
        $icon->img = 'img/general/no-icon.jpg';
        $icon->save();
    }
}
