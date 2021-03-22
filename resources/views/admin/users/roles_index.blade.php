@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Роли для зарегистрированных пользователей</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('roles.create')}}" type="button" class="btn btn-primary mb-3">Создать</a>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">N</th>
                                <th>Наименование</th>
                                <th>Разрешения</th>
                                <th style="width: 10px">ID</th>
                                <th>Редактировать</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td>{{$role->name ?? ''}}</td>
                                <td>
                                    @forelse ($role->permissions as $permission)
                                        <span class="badge badge-info">{{ $permission->name }}</span>
                                    @empty
                                        <span class="badge badge-secondary">не задано</span>
                                    @endforelse
                                </td>
                                <td style="text-align: center">{{$role->id}}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Вы уверены в необходимости удаления роли?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                            {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
