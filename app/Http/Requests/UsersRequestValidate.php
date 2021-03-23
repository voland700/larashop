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
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.email' =>  'Не корректный Email адрес',
            'email.unique' =>  'Данный Email-адрес используется другим пользователем',
            'password.confirmed' => 'Данные пароля и подтвержедения не совпадают'
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'confirmed'
        ];
    }
}
