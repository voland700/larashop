@extends('admin.layouts.layout')
@section('content')

    <div class="content">

            @if (count($errors) > 0)
                <div class="col-md-12">
                <div class="card bg-danger">
                    <div class="card-header">

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                </div>
            @endif

            <form role="form" action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12">
                                    <label for="name">Имя пользователя</label><code>*</code>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label><code>*</code>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Подтвердите пароль</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control @error('password') is-invalid @enderror" id="password_confirmation">
                                </div>

                                <h6 style="font-weight: 700; font-size: 1rem;">Роль пользователя</h6>
                                <div class="form-group">
                                    @foreach($roles as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" value="{{$role->id}}" {{$role->id == $userRole ? 'checked' : ''}}>
                                        <label class="form-check-label" >{{$role->name}}</label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div><!-- ./Card row -->
                    </div><!-- ./CARD-BODY -->
                    <div class="card-footer clearfix"><p></p></div>
                </div> <!-- ./card -->
                </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Обновить</button>
                </div>
            </form>
    </div>
@endsection

