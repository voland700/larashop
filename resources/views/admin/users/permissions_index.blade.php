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
                        <h3 class="card-title">Список разрешений</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('permissions.create')}}" type="button" class="btn btn-primary mb-3">Создать</a>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">N</th>
                                <th>Наименование</th>
                                <th style="width: 10px">ID</th>
                                <th>Редактировать</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td>{{$permission->name ?? ''}}</td>
                                <td style="text-align: center">{{$permission->id}}</td>
                                <td>
                                    <a href="{{ route('permissions.edit',  $permission->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('permissions.destroy',  $permission->id) }}" method="POST" onsubmit="return confirm('Вы уверены в необходимости удаления пользователя?');" style="display: inline-block;">
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
                            {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
