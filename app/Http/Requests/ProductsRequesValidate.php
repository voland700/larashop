<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequesValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Название товара" обязательно для заполнения',
            'slug.required' => 'Поле "Символьный код" обязательно для заполнения',
            'slug.unique' => 'Данные в поле "Символьный код" должны быть уникальными',
            'img.image' => 'Основное изображение - должно быть файлом c изображением',
            'img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'img.size' => 'Размер изображения не должен превышать 2 мб.',
            'prev_img.image' => 'Основное изображение - должно быть файлом c изображением',
            'prev_img.mimes' => 'Фал с изображением должен иметь расширение: jpeg,jpg,bmp,png',
            'prev_img.size' => 'Размер изображения не должен превышать 2 мб.',
            'image.image' => 'Доплнительные изображения - должны быть файлами изображений',
            'image.mimes' => 'Фалы доплнительных изображениий должны иметь расширение: jpeg,jpg,bmp,png',
            'image.size' => 'Размер доплнительных изображениий не должен превышать 2 мб.',
            'sort.integer' => 'Номер сортровки должен быть целым числом',
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug'=>'required|unique:categories',
            'img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'img.size' => '2048|nullable',
            'prev_img' => 'image|mimes:jpeg,jpg,bmp,png|nullable',
            'prev_img.size' => '2048|nullable',
            'sort' => 'integer|nullable',
        ];

        $image = count($this->input('image'));
        foreach(range(0, $image) as $index) {
            $rules['image.' . $index] = 'image|mimes:jpeg,jpg,bmp,png|max:2000';
        }
        return $rules;
    }
}
