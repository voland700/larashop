<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequestValidate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = 'Зарегистрированные пользователи';
        $users = User::with('roles')->paginate(40);
        return view('admin.users.users_index', compact('h1', 'users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = "Создание нового пользователя";
        $roles = Role::get();
        return view('admin.users.users_create', compact('h1', 'roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequestValidate $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole($request->role);
        return redirect()->route('users.index')->with('success', 'Пользователь создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $h1 = 'Данные пользователя';
        $user = User::with('roles')->find($id);
        $userRole = $user->roles->toArray()[0]['name'];
        return view('admin.users.users_show', compact('h1', 'user', 'userRole'));
        //dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $h1 = "Обновить данные пользователя";
        $user = User::with('roles')->find($id);
        $roles = Role::get();
        $userRole = $user->roles->toArray()[0]['id'];
        return view('admin.users.users_update', compact('h1', 'user', 'roles', 'userRole'));

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
        $user = User::find($id);

        $messages = [
            'name.required' => 'Поле "Наименование" обязательно для заполнения',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.email' =>  'Не коллектный Email адрес',
            'email.unique' =>  'Данный Email-адрес используется другим пользователем',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
        ];
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ],$messages);

        $user->name=$request->name;
        $user->email = $request->email;
        if ($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        $user->update();
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'Данные пользователя обновлены');

        //dd($user->roles);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'Данные пользователя удалены');
    }

    public function search(Request $request)
    {
        $h1 = 'Результаты поиска: <em>'.$request->search.'</em>';
        $users = User::where('name', 'LIKE', '%' . $request->search . '%')->with('roles')->paginate(40);
        return view('admin.users.users_index', compact('h1', 'users'));

    }

}
