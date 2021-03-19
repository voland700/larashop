<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advantage;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1='Список торговых преимуществ для товаров';
        $advantages = Advantage::all()->sortBy('sort');
        return view('admin.advantage_index', compact('h1', 'advantages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = 'Создание торгового преимущества для товара';
        return view('admin.advantage_create', compact('h1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $advantage = new Advantage($request->all());
        $advantage->active = $request->has('active') ? 1 : 0;
        $messages = [
            'name.required' => 'Поле Наименование обязательно для заполнения',
            'sort.integer' => 'В поле Сортировка  должно указано числовое значение',
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'nullable|integer'
        ],$messages);


        return redirect()->route('advantages.index')->with('success', 'Торговое преимущество добавлено добавлено');

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
        $h1 = 'Редактирование торгового преимущества';
        $advantage = Advantage::find($id);
        return view('admin.advantage_update', compact('h1', 'advantage'));
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
            'name.required' => 'Поле Наименование обязательно для заполнения',
            'sort.integer' => 'В поле Сортировка  должно указано числовое значение',
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'nullable|integer'
        ],$messages);
        $advantage = Advantage::find($id);
        $advantage->active = $request->has('active') ? 1 : 0;
        $advantage->update($request->all());
        return redirect()->route('advantages.index')->with('success', 'Данные преимущества обновлены');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advantage = Advantage::find($id);
        $advantage->delete();
        return redirect()->route('advantages.index')->with('success', 'Торговое преимущество удалено');
    }
}
