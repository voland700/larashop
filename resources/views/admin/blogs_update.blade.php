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

            <form role="form" action="{{ route('blogs.update', $blog->id) }}" method="post" id="CreateForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Данные статьи</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="{{$blog->active}}" type="checkbox" @if($blog->active) checked @endif onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Активно</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{$blog->sort}}">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название статьи</label><code>*</code>
                                    <input type="text" id="CreateName" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $blog->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Символьный код</label><code>*</code>
                                    <input type="text" id="CreateSlug" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="{{$blog->slug }}">
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Основное изображение</label>
                                        <div class="slider_img_wrup">
                                            <div class="slider_img_inner">
                                                @if($blog->img)
                                                    <img src="{{asset($blog->img)}}" class="slider_img">
                                                    <a href="{{route('blogs_images_remove')}}" data-id="{{$blog->id}}" data-type="img" class="product_img_btn" onclick="ServiseImgRemove(event);"><i class="fas fa-times"></i></a>
                                                @else
                                                    <img src="{{asset('img/general/no-photo_small.jpg')}}" class="slider_img">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="img" value="{{$blog->img}}" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                                <label class="custom-file-label" for="img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Prev изображение</label>
                                        <div class="slider_img_wrup">
                                            <div class="slider_img_inner">
                                                @if($blog->prev_img)
                                                    <img src="{{asset($blog->prev_img)}}" class="slider_img">
                                                    <a href="{{route('blogs_images_remove')}}" data-id="{{$blog->id}}" data-type="prev_img" class="product_img_btn" onclick="ServiseImgRemove(event);"><i class="fas fa-times"></i></a>
                                                @else
                                                    <img src="{{asset('img/general/no-photo_small.jpg')}}" class="slider_img">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="prev_img" value="{{ $blog->prev_img }}" class="custom-file-input @error('prev_img') is-invalid @enderror" id="prev_img">
                                                <label class="custom-file-label" for="prev_img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="location">Размещение изображения</label>
                                    <select name="location" class="form-control" id="choiceIcon">
                                        <option value="	center">По центру</option>
                                        <option value="left">Слево</option>
                                        <option value="right">Справо</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="exampleInputFile">Добавить изображения галереи</label>
                                    <div class="input-group">
                                        <div class="dropzone" id="dropzone" style="width: 100%; border: 1px dashed #ced4da; border-radius: .25rem"
                                             data-url="{{route('blogs_img_upload')}}"
                                             data-remove="{{route('blogs_img_remove')}}">
                                        </div>
                                    </div>
                                </div>
                                @if(!$galleries->isEmpty())
                                <div class="form-group">
                                    <p class="ml-2 mb-1"><strong>Изображения галереи</strong></p>
                                        @if(count($galleries)>1)
                                            <div class="product_photo_del_wrap"><a href="{{route('blogs_gallery_all_remove')}}" data-id="{{$blog->id}}" class="product_photo_delAll" onclick="galleryAllRemove(event);"><span>очистить все</span> <i class="fas fa-times"></i></a></div>
                                        @endif
                                        <div class="product_photo_wrup">
                                            @foreach($galleries as $gallery)
                                                <div class="product_photo_inner">
                                                    <img src="{{asset($gallery->thumbnail)}}"  class="product_photo">
                                                    <a href="{{route('blogs_gallery_remove')}}" class="product_img_btn" data-id="{{$gallery->id}}" onclick="galleryRemove(event);"><i class="fas fa-times"></i></a>
                                                </div>
                                            @endforeach
                                        </div>
                                </div>
                                @endif





                                <h5 class="mb-3 mt-5">Мета данные</h5>

                                <div class="form-group col-md-12">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" id="h1" class="form-control" name="h1" value="{{ $blog->h1 }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_title">meta title</label>
                                    <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{ $blog->meta_title }}">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_keys">meta keywords</label>
                                    <input type="text" id="meta_keys" class="form-control" name="meta_keys" value="{{ $blog->meta_keys }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta discription</label>
                                    <textarea class="form-control" name="meta_description" rows="3">{{ $blog->meta_description }}</textarea>
                                </div>

                                <div class="form-group mt-5">
                                    <label for="description">Описание</label>
                                    <textarea class="form-control" name="description" rows="7">{{ $blog->description }}</textarea>
                                </div>


                            </div>

                        </div><!-- ./Card row -->
                    </div><!-- ./CARD-BODY -->
                    <div class="card-footer clearfix">
                            <p></p>
                    </div>
               </div> <!-- ./card -->
             </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3" id="btnForm">Обновить</button>
             </div>
        </form>
    </div>
    @include('admin.layouts.dropzone_js')
@endsection

