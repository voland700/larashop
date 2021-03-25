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

            <form role="form" action="{{ route('permissions.update', $permission->id) }}" method="post"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header"><a href="{{route('permissions.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <label for="name">Наименование разрешения</label><code>*</code>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $permission->name}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer clearfix"><p></p></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Обновить</button>
                </div>
             </form>
    </div>
@endsection

