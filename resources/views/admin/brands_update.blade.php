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

            <form role="form" action="{{ route('brands.update', $brand->id) }}" method="post" id="bannerForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Данные производителя</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="{{$brand->active}}" type="checkbox" @if($brand->active) checked @endif onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Производитель активен</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="slider" id="slider" value="{{$brand->slider}}" type="checkbox"  @if($brand->slider) checked @endif onchange="checkboxToggle()">
                                        <label class="form-check-label" for="slider">В слайдере на главной</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{$brand->sort}}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name">Название призводителя</label><code>*</code>
                                    <input type="text" id="CreateName" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $brand->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Символьный код</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="{{ $brand->slug }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="img">Изображение логотипа</label>
                                    <div class="slider_img_wrup">
                                        <div class="brand_img_inner">
                                            <img src="{{asset($brand->img)}}" alt="{{$brand->name}}" class="brand_img">
                                            @if($brand->img !=="img/general/no_banner.jpg")
                                                <a href="{{route('brand_img_remove')}}" data-id="{{$brand->id}}" class="product_img_btn" onclick="bannerRemove(event);"><i class="fas fa-times"></i></a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="img" name="img" value="{{ $brand->img }}" class="custom-file-input @error('img') is-invalid @enderror">
                                            <label class="custom-file-label" for="img">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-5">Мета данные производителя</h5>

                                <div class="form-group col-md-12">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" id="h1" class="form-control" name="h1" value="{{ $brand->h1 }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_title">meta title</label>
                                    <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{ $brand->meta_title }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_keys">meta keywords</label>
                                    <input type="text" id="meta_keys" class="form-control" name="meta_keys" value="{{ $brand->meta_keys }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta discription</label>
                                    <textarea class="form-control" name="meta_description" rows="3">{{ $brand->meta_description }}</textarea>
                                </div>

                                <div class="form-group mt-5">
                                    <label for="description">Описание производителя</label>
                                    <textarea class="form-control" name="description" rows="7">{{ $brand->description }}</textarea>
                                </div>

                            </div>

                        </div><!-- ./Card row -->
                    </div><!-- ./CARD-BODY -->
                    <div class="card-footer clearfix">
                            <p></p>
                    </div>
               </div> <!-- ./card -->
             </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Обновить</button>
             </div>
        </form>
    </div>
@endsection

