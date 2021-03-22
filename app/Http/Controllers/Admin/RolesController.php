<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UsersRequestValidate;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $h1 = "Список ролей пользователей";
        $roles = Role::with('permissions')->paginate(40);
        return view('admin.users.roles_index', compact('h1', 'roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $h1 = "Создать новую роль для пользователей";
        $permissions = Permission::get();
        return view('admin.users.roles_create', compact('h1', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequestValidate $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->syncPermissions($request->permission);
        $role->save();
        return redirect()->route('roles.index')->with('success', 'Роль успешно создана');
        //dd($request->all());
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
        $h1= "Редактирование роли";
        $role = Role::with('permissions')->find($id);
        $permissionsSelected = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::get();
        return view('admin.users.roles_update', compact('h1', 'role', 'permissions', 'permissionsSelected'));

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
        $role = Role::find($id);
        $role->name = $request->name;
        $role->syncPermissions($request->permission);
        $role->update();
        return redirect()->route('roles.index')->with('success', 'Данные успешно обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Role::destroy($id);
       return redirect()->route('roles.index')->with('success', 'Данные роли удалены');
    }
}
