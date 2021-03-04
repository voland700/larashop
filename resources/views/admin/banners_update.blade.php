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

            <form role="form" action="{{ route('banners.update', $banner->id ) }}" method="post" id="bannerForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Данные баннера</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="{{$banner->active}}" type="checkbox" @if($banner->active) checked @endif onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Баннер активен</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{$banner->sort}}">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название, заголовок баннера</label><code>*</code>
                                    <input type="text" class="form-control" name="name" value="{{$banner->name}}">
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="img">Изображение баннера</label><code>*</code>
                                        <div class="slider_img_wrup">
                                            <div class="brand_img_inner">
                                                <img src="{{asset($banner->img)}}" alt="{{$banner->name}}" class="brand_img">
                                                @if($banner->img !== "img/general/no_banner.jpg")
                                                    <a href="{{route('banner_remove')}}" data-id="{{$banner->id}}" class="product_img_btn" onclick="bannerRemove(event);"><i class="fas fa-times"></i></a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="img" value="{{ $banner->img }}" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                                <label class="custom-file-label" for="img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group col-md-12">
                                    <label for="link">Сылка для перехода</label>
                                    <input type="text" class="form-control"  name="link" value="{{ $banner->link }}">
                                </div>


                                <div class="form-group">
                                    <label for="text">Текст на слайде</label>
                                    <textarea class="form-control" name="text" rows="3" placeholder="Текст на слайде">{{ $banner->text }}</textarea>
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

