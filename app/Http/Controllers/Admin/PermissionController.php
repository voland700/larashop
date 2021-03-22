<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UsersRequestValidate;




class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = "Разрешения для пользователей";
        $permissions = Permission::paginate(40);
        return view('admin.users.permissions_index', compact('h1', 'permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = "Создать новое разрешение для пользователей";
        return view('admin.users.permissions_create', compact('h1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequestValidate $request)
    {
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success', 'Зазрешение успешно создано');

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
        $h1 = "Обновить данные разрешения";
        $permission = Permission::find($id);
        return view('admin.users.permissions_update', compact('h1', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequestValidate $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->update();
        return redirect()->route('permissions.index')->with('success', 'Данные азрешения обнавлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);
        return redirect()->route('permissions.index')->with('success', 'Данные разрешения удалены');
    }
}
