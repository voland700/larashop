@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <a href="{{route('users.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Данные пользователя: {{ $user->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">N</th>
                                <th>Поле</th>
                                <th>Значение</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td>1</td><td><b>Login</b></td><td><em>{{$user->name}}</em></td></tr>
                            <tr><td>2</td><td><b>Email</b></td><td><em>{{$user->email}}</em></td></tr>
                            <tr><td>3</td><td><b>Роль</b></td><td><em>{{$userRole}}</em></td></tr>
                            <tr><td>4</td><td><b>Дата регистрации</b></td><td><em>{{$user->created_at}}</em></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix"><p></p></div>
                </div>
            </div>
        </div>
    </div>
@endsection
