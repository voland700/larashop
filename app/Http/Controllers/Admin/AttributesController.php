<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function index()
    {
        $h1 = 'Спсиок характеристик для товаров';
        $attributes = Attribute::all()->sortBy('sort');
        return view('admin.attributes_index', compact('h1', 'attributes'));
    }

    public function create()
    {
        $h1  = 'Добавить новую характеристику';
        return view('admin.attributes_create', compact('h1' ));
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Поле Наименование обязательно для заполнения',
            'sort.integer' => 'Поле Сортировка  должно указано числовое значение',
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'nullable|integer'
        ],$messages);
        Attribute::create($request->all());
        return redirect()->route('attributes.index')->with('success', 'Характеристика добавлена');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        $h1 = 'Редактироание характеристики '.$attribute->name;
        return view('admin.attributes_edit', compact('h1', 'attribute'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Поле Наименование обязательно для заполнения',
            'sort.integer' => 'Поле Сортировка  должно указано числовое значение',
        ];
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'nullable|integer'
        ],$messages);
        $attribute = Attribute::find($id);
        $attribute->update($request->all());
        return redirect()->route('attributes.index')->with('success', 'Данные изменены');
    }

    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        //Link::where('partner_id', $id)->delete(); - образец удаления всех характеристих и значений из смежной таблицы
        $attribute->delete();
        return redirect()->route('attributes.index')->with('success', 'Данные характиристики '.$attribute->name.' удалены');
    }
}
