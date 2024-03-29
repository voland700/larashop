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
                        <h3 class="card-title">Список пользователей</h3>
                        <div class="card-tools">
                            <form action="{{route('users_search')}}" method="post">
                                <div class="input-group input-group-sm" style="width: auto">
                                    @csrf
                                    <input type="text" name="search" class="form-control float-right"  value="{{ old('search') }}" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('users.create')}}" type="button" class="btn btn-primary mb-3">Создать</a>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">N</th>
                                <th>Наименование</th>
                                <th>Email</th>
                                <th>Роли</th>
                                <th>Редактировать</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td>{{$user->name ?? ''}}</td>
                                <td>{{$user->email ?? ''}}</td>
                                <td>
                                    @forelse ($user->roles as $role)
                                        {{ $role->name }}
                                    @empty
                                        нет роли
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Вы уверены в необходимости удаления пользователя?');" style="display: inline-block;">
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
                            {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_del">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Внимание!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="form_content"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <form action="" method="POST" id="sendBtn">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div><!-- /.модальное окно-Содержание -->
        </div><!-- /.модальное окно-диалог -->
    </div><!-- /.модальное окно -->





@endsection
