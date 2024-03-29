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

            <form role="form" action="{{ route('categories.store') }}" method="post"  enctype="multipart/form-data">
                @csrf
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
                                        <input class="form-check-input" name="active" id="active" value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Категория активна</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="main" id="main" type="checkbox">
                                        <label class="form-check-label" for="main">Категория на главной</label>
                                    </div>
                                </div>

                                <div class="form-group col-3">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="500" placeholder="500">
                                </div>

                            <div class="form-group">
                                <label for="name">Наименование категории</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="CreateName" name="name" value="" placeholder="Наименование категории">
                            </div>

                            <div class="form-group">
                                <label for="name">ЧПУ категории</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="" placeholder="category">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Родительская категория</label>
                                <select name="parent_id" class="form-control">
                                    <option  value="">Нет родительской</option>
                                    @php
                                        $traverse = function ($categories, $prefix = '-&ensp;') use (&$traverse) {
                                            foreach ($categories as $category) {
                                                echo '<option  value="'.$category->id.'">'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                                                $traverse($category->children, $prefix.'-&ensp;');
                                            }
                                         };
                                        $traverse($categories);
                                    @endphp
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile">Основное изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                            <label class="custom-file-label" for="img">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile">Prev изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="prev_img" class="custom-file-input @error('prev_img') is-invalid @enderror" id="prev_img">
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
                                    <input type="text" class="form-control" id="h1" name="h1" placeholder="Заголовок категории">
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Meta TITLE</label>
                                    <textarea class="form-control" rows="3" name="meta_title" placeholder="Enter ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta DESCRIPTION</label>
                                    <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ..."></textarea>
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
                                    <textarea class="form-control ckEditor" rows="7" name="description" id="description" placeholder="Описание категории"></textarea>
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
@endsection
