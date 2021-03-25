@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                @if (count($errors) > 0)
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
                @endif
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('attributes.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Создать новую характеристику</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form" method="post" action="{{ route('attributes.update', $attribute->id ) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Наименование</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"   value="{{ $attribute->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sort" class="col-sm-2 col-form-label">Сортировка</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{$attribute->sort}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Сохранииь</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
