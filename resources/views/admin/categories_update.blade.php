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

            <form role="form" action="{{ route('categories.update', $category->id) }}" method="post"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">


                    <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Общие данные категорий</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active"value="{{$category->id}}" type="checkbox" {{($category->id=1) ? 'checked=""' : ''}} onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Категория активна</label>
                                    </div>
                                </div>

                                <div class="form-group col-3">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{$category->sort}}">
                                </div>

                            <div class="form-group">
                                <label for="name">Наименование категории</label>
                                <input type="text" class="form-control" id="CreateName" name="name" value="{{$category->name}}">
                            </div>

                            <div class="form-group">
                                <label for="name">ЧПУ категории</label>
                                <input type="text" class="form-control" id="CreateSlug" name="slug" value="{{$category->slug}}">
                            </div>



                            <div class="form-group">
                                <label for="category_id">Родительская категория</label>
                                <select name="parent_id" class="form-control">
                                    @php
                                        $traverse = function ($categories, $prefix = '-&ensp;', $selectedId=NULL) use (&$traverse) {
                                            foreach ($categories as $category) {
                                                $checked = ($category->id == $selectedId) ? 'selected' : '';
                                                echo  '<option value="'.$category->id.'" '.$checked.'>'.$prefix.' '.$category->name.'</option>';;
                                                $traverse($category->children, $prefix.'-&ensp;', $selectedId);
                                            }
                                        };
                                        $traverse($categories, '-&ensp;', $id);
                                    @endphp
                                </select>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">


                                    <label for="exampleInputFile">Основное изображение</label>
                                    <div class="admin_category_img_wrap">
                                        <div class="admin_category_img_block">
                                            <img src="{{asset($category->image)}}" alt="" class="admin_category_img">
                                        </div>
                                        @if($category->img)
                                        <span>
                                            <a href="#" class="admin_category_btn_del"><i class="fas fa-times"></i></a>
                                        </span>
                                        @endif

                                    </div>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input" id="img">
                                            <label class="custom-file-label" for="img">Choose file</label>
                                        </div>
                                    </div>


                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile">Prev изображение</label>
                                    <div class="admin_category_img_wrap">
                                        <div class="admin_category_img_block">
                                            <img src="{{asset($category->thumbnail)}}" alt="" class="admin_category_img">
                                        </div>
                                        @if($category->img)
                                        <span>
                                            <a href="#" class="admin_category_btn_del"><i class="fas fa-times"></i></a>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="prev_img" class="custom-file-input" id="prev_img">
                                            <label class="custom-file-label" for="prev_img">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer clearfix">
                            <p></p>
                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">SEO данные категории</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" class="form-control" id="h1" name="h1" value="{{$category->h1}}">
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Meta TITLE</label>
                                    <textarea class="form-control" rows="3" name="meta_title">{{$category->meta_title}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta DESCRIPTION</label>
                                    <textarea class="form-control" rows="3" name="meta_description">{{$category->meta_description}}</textarea>
                                </div>

                            </div>
                            <div class="card-footer clearfix">
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Общие данные категорий</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- textarea -->
                                <div class="form-group">
                                    <label for="description">Описание для категории</label>
                                    <textarea class="form-control ckEditor" rows="7" name="description" id="description">{{$category->description}}</textarea>
                                </div>

                            </div>
                            <div class="card-footer clearfix">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Создать</button>
                </div>
            </form>


    </div>






    <div class="modal fade" id="modal_del">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Внимание!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="form_content"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <form action="" method="POST" id="sendBtn">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div><!-- /.модальное окно-Содержание -->
        </div><!-- /.модальное окно-диалог -->
    </div><!-- /.модальное окно -->





@endsection
