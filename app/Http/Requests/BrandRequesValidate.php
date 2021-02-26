<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequesValidate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название призводителя" обязательно для заполнения',
            'slug.required' => 'Поле "Символьный код" обязательно для заполнения',
            'slug.unique' => 'Данные в поле "Символьный код" должны быть уникальными',
            'img.image' => 'Основное изображение - должно быть файлом c изображением',
            'img.mimes' => 'Фал с изображением логотипа должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения логотипа не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug'=>'required|unique:brand',
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'sort' => 'integer|nullable',
        ];
    }
}
