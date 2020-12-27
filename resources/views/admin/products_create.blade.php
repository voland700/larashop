@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">

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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основные данные товара</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="active" id="active" value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                <label class="form-check-label" for="active"><strong>Товар активен</strong></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check toggle">
                                        <input class="form-check-input" name="hit" id="hit" value="0" type="checkbox">
                                        <label class="form-check-label" >Популярный</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check toggle">
                                        <input class="form-check-input" name="new" id="new" value="0" type="checkbox">
                                        <label class="form-check-label">Новинка</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group toggle">
                                    <div class="form-check">
                                        <input class="form-check-input" name="stock" id="stock" value="0" type="checkbox">
                                        <label class="form-check-label">Товар со скидкой</label>
                                    </div>
                                </div>

                                <div class="form-group toggle">
                                    <div class="form-check">
                                        <input class="form-check-input" name="advice" id="advice" value="0" type="checkbox">
                                        <label class="form-check-label">Советуемн</label>
                                    </div>
                                </div>
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
                            <label for="name">Символьный код</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="" placeholder="category">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Родительская категория</label>
                            <select name="	category_id" class="form-control">
                                @php
                                    $traverse = function ($categories, $prefix = '-&ensp;', $category_id = 'NULL') use (&$traverse) {
                                        echo '<option  value="NULL"'.($category_id == NULL) ? 'selected' : ''.'>Нет родительской</option>';
                                        foreach ($categories as $category) {
                                            $selected = ($category_id == $category->id) ? 'selected' : '';
                                            echo '<option  value="'.$category->id.'"'.$selected.'>'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                                            $traverse($category->children, $prefix.'-&ensp;', $category_id);
                                        }
                                     };
                                    $traverse($categories, '-&ensp;', $category_id);
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

                        <div class="form-group">
                            <p class="ml-2 mb-1"><strong>Доплнительные изображения</strong></p>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"  name="img[]" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
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
                            <h3 class="card-title">Характеристики товара</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">




                        </div>
                        <div class="card-footer clearfix">
                            <p></p>
                        </div>
                    </div>
                </div>




















        </div>
    </div>







@endsection
