<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequestValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'slug.required' => 'Поле "Символьный код" обязательно для заполнения',
            'slug.unique' => 'Данные в поле "Символьный код" должны быть уникальными',
            'img.image' => 'Основное изображение - должно быть файлом c изображением',
            'img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения  не должен превышать 2 мб.',
            'prev_img.image' => 'Дополнительное изображение - должно быть файлом c изображением',
            'prev_img.mimes' => 'Фал с доплнительным изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'prev_img.size' => 'Размер доплнительного изображения  не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug'=>'required|unique:brand',
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'prev_img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'prev_img.size' => '2048|nullable',
            'sort' => 'integer|nullable'
        ];
    }
}
