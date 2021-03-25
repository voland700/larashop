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

            <form role="form" action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <a href="{{route('roles.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12">
                                    <label for="name">Название роли</label><code>*</code>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Наименование роли" required>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="permission">Разрешения для роли</label>
                                    <select name="permission[]" id="permission" class="form-control select2" multiple="multiple" style="width: 100%;" >
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div><!-- ./Card row -->
                    </div><!-- ./CARD-BODY -->
                    <div class="card-footer clearfix">
                            <p></p>
                    </div>
               </div> <!-- ./card -->
             </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Создать</button>
             </div>
        </form>
    </div>
@endsection

