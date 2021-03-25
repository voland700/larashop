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

            <form role="form" action="{{ route('slider_icons.store') }}" method="post" id="bannerForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <a href="{{route('slider_icons.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Данные преимущества</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Активно</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="50" placeholder="50">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название, заголовок</label><code>*</code>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Заголовок баннера" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="img">Иконка преимущества</label><code>*</code>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" value="{{ old('img') }}" class="custom-file-input @error('img') is-invalid @enderror">
                                            <label class="custom-file-label" for="img">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="link">Сылка для перехода</label>
                                    <input type="text" class="form-control"  name="link" value="{{ old('link') }}" placeholder="Добавте ссылку">
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

