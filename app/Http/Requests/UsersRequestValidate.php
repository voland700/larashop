<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequestValidate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Наименование" обязательно для заполнения'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
