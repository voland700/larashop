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

            <form role="form" id="updateForm" action="{{ route('services.update', $service->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <a href="{{route('services.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Данные предложения услуг</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="{{$service->active}}" type="checkbox" @if($service->active) checked @endif  onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Предложение активно</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{$service->sort}}" @if($service->sort) checked @endif>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название предложения</label><code>*</code>
                                    <input type="text" id="CreateName" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$service->name}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Символьный код</label><code>*</code>
                                    <input type="text" id="CreateSlug" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="{{ $service->slug }}">
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Основное изображение</label>
                                        <div class="slider_img_wrup">
                                            <div class="slider_img_inner">
                                                @if($service->img)
                                                <img src="{{asset($service->img)}}" class="slider_img">
                                                    <a href="{{route('service_img_remove')}}" data-id="{{$service->id}}" data-type="img" class="product_img_btn" onclick="ServiseImgRemove(event);"><i class="fas fa-times"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="img" value="{{$service->img}}" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                                <label class="custom-file-label" for="img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Prev изображение</label>
                                        <div class="slider_img_wrup">
                                            <div class="slider_img_inner">
                                                @if($service->prev_img)
                                                    <img src="{{asset($service->prev_img)}}" class="slider_img">
                                                    <a href="{{route('service_img_remove')}}" data-id="{{$service->id}}" data-type="prev_img" class="product_img_btn" onclick="ServiseImgRemove(event);"><i class="fas fa-times"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="prev_img" value="{{ $service->prev_img }}" class="custom-file-input @error('prev_img') is-invalid @enderror" id="prev_img">
                                                <label class="custom-file-label" for="prev_img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="location">Размещение изображения</label>
                                    <select name="location" class="form-control" id="choiceIcon">
                                        <option value="center" {{($service->icon == 'center')? 'selected' : ''}}>По центру</option>
                                        <option value="left" {{($service->icon == 'left')? 'selected' : ''}}>Слево</option>
                                        <option value="right" {{($service->icon == 'right')? 'selected' : ''}}>Справо</option>
                                    </select>
                                </div>


                                <h5 class="mb-3 mt-5">Мета данные</h5>

                                <div class="form-group col-md-12">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" id="h1" class="form-control" name="h1" value="{{ $service->h1 }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_title">meta title</label>
                                    <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{ $service->meta_title }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_keys">meta keywords</label>
                                    <input type="text" id="meta_keys" class="form-control" name="meta_keys" value="{{ $service->meta_keys }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta discription</label>
                                    <textarea class="form-control" name="meta_description" rows="3">{{ $service->meta_description }}</textarea>
                                </div>

                                <div class="form-group mt-5">
                                    <label for="description">Описание</label>
                                    <textarea class="form-control" name="description" rows="7">{{ $service->description }}</textarea>
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

