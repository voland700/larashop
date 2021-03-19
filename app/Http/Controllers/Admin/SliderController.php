<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = 'Спсиок характеристик для товаров';
        $sliders = Slider::all()->sortBy('sort');
        return view('admin.sliders_index', compact('h1', 'sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1='Создание нового слайда';
        return view('admin.sliders_create', compact('h1', ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slide = new Slider($request->all());
        $slide->active = $request->has('active') ? 1 : 0;
        $messages = [
            'background.required' => 'Основная картинка для слайда - обязательна',
            'background.image' => 'Картинка для слайда - должна быть файлом c изображением',
            'background.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'background.size' => 'Размер изображения не должен превышать 2 мб.',
            'img.image' => 'Картинка для слайда - должна быть файлом c изображением',
            'img.size' => 'Размер изображения не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
        $this->validate($request, [
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'background' => 'required|image|mimes:jpeg,jpg,bmp,png|nullable',
            'background.size' => '2048|nullable',
            'sort' => 'integer|nullable'
        ],$messages);
        if($request->hasFile('background')) {
            $image = $request->file('background');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $slide->background = 'storage'.$path_to.'/'.$fileName;
        }
        if($request->hasFile('img')) {
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $slide->img = 'storage'.$path_to.'/'.$fileName;
        }

        $slide->save();
        return redirect()->route('sliders.index')->with('success', 'Слайд создан');
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
        $h1 = 'Редактирование слайда';
        $slide = Slider::find($id);
        $slide->btn = ($slide->img == 'img/general/no-slide.jpg') ? false : true;
        return view('admin.sliders_update', compact('h1',  'slide'));

        //dd($slide);
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
        $slide = Slider::find($id);
        $data = $request->all();
        $data['active']= $request->has('active') ? 1 : 0;
        if ($request->hasFile('img')) {
            if (Storage::disk('public')->exists(str_replace('storage', '', $slide->img))){
                Storage::disk('public')->delete(str_replace('storage', '', $slide->img));
            }
            $image = $request->file('img');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['img'] = 'storage'.$path_to.'/'.$fileName;
        }

        if ($request->hasFile('background')) {

            if (Storage::disk('public')->exists(str_replace('storage', '', $slide->background))){
                Storage::disk('public')->delete(str_replace('storage', '', $slide->background));
            }
            $image = $request->file('background');
            $fileName =  time().'_'.Str::lower(Str::random(5)).'.'.$image->getClientOriginalExtension();
            $path_to = '/upload/images/'.getfolderName();
            $image->storeAs('public'.$path_to, $fileName);
            $data['background'] = 'storage'.$path_to.'/'.$fileName;
        }
        $slide->update($data);
        return redirect()->route('sliders.index')->with('success', 'Слайд обнавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slider::find($id);
        if (Storage::disk('public')->exists(str_replace('storage', '', $slide->img))){
            Storage::disk('public')->delete(str_replace('storage', '', $slide->img));
        }
        if (Storage::disk('public')->exists(str_replace('storage', '', $slide->background))){
            Storage::disk('public')->delete(str_replace('storage', '', $slide->background));
        }
        $slide->delete();
        return redirect()->route('sliders.index')->with('success', 'Слайд удалён');
    }
}
