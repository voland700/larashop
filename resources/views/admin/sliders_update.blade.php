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

            <form role="form" action="{{ route('sliders.update', $slide->id) }}" method="post" id="SlidersForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Данные слайда</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="{{$slide->active}}" type="checkbox" @if($slide->active) checked @endif onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Скидка активна</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{$slide->sort}}">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название, заголовок слйда</label><code>*</code>
                                    <input type="text" class="form-control name="name" value="{{$slide->name}}">
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Основное изображение - фон</label><code>*</code>
                                        <div class="slider_img_wrup">
                                            <div class="slider_img_inner">
                                                <img src="{{asset($slide->background)}}" alt="{{$slide->name}}" class="slider_img">
                                                @if($slide->background !== 'img/general/no-slide.jpg')
                                                    <a href="{{route('slide_remove')}}" data-id="{{$slide->id}}" data-type="background" class="product_img_btn" id="slideBackground" onclick="slideRemove(event);"><i class="fas fa-times"></i></a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="background" value="{{ $slide->background }}" class="custom-file-input @error('background') is-invalid @enderror" id="background">
                                                <label class="custom-file-label" for="background">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Изображение слайда</label>
                                        <div class="slider_img_wrup">
                                            <div class="slider_img_inner">
                                                @if($slide->img)
                                                <img src="{{asset($slide->img)}}" alt="{{$slide->name}}" class="slider_img">
                                                <a href="{{route('slide_remove')}}" data-id="{{$slide->id}}" data-type="img" class="product_img_btn" id="slideImg" onclick="slideRemove(event);"><i class="fas fa-times"></i></a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="img" value="{{ $slide->img }}" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                                <label class="custom-file-label" for="img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="color">Цвет текста</label>
                                        <select name="color" class="form-control">
                                            <option value="slider_dark" {{ ($slide->color == 'slider_dark')? 'selected' : ''}}>Темный</option>
                                            <option value="slider_light" {{ ($slide->color == 'slider_light')? 'selected' : ''}}>Светлый</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text">Текст на слайде</label>
                                    <textarea class="form-control" name="text" rows="3" placeholder="Текст на слайде">{{ $slide->text }}</textarea>
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

