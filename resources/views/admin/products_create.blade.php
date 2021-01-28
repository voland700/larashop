@extends('admin.layouts.layout')
@section('content')

    <div class="content pb-3">
        <div class="row">

            @if (count($errors) > 0)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body bg-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <form action="{{route('product_create')}}" method="post"  enctype="multipart/form-data">
            @csrf

        <div class="row">

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
                                        <label class="form-check-label">Советуем</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-3">
                            <label for="sort">Сортировка</label>
                            <input type="text" class="form-control" id="sort" name="sort" value="500" placeholder="500">
                        </div>

                        <div class="form-group">
                            <label for="name">Название товра</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="CreateName" name="name" value="{{ old('name') }}" placeholder="Наименование категории">
                        </div>

                        <div class="form-group">
                            <label for="name">Символьный код</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="{{ old('slug') }}" placeholder="category">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Родительская категория</label>
                            <select name="category_id" class="form-control">
                                @php
                                    echo '<option  value="NULL" class="text-black-50">Нет родительской</option>';
                                $traverse = function ($categories, $prefix = '-&ensp;', $category_id = 'NULL') use (&$traverse) {
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
                                        <input type="file" name="img" value="{{ old('img') }}" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                        <label class="custom-file-label" for="img">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Prev изображение</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="prev_img" value="{{ old('prev_img') }}" class="custom-file-input @error('prev_img') is-invalid @enderror" id="prev_img">
                                        <label class="custom-file-label" for="prev_img">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <p class="ml-2 mb-1"><strong>Доплнительные изображения</strong></p>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile"  name="image[]" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Стоимость товара товара</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="base_price" class="col-sm-2 col-form-label">Цена</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="base_price" value="{{ old('base_price') }}" id="base_price" placeholder="Цена">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Валюта</label>
                                    <div class="col-sm-9">
                                        <select name="currency"  class="form-control">
                                            <option value="RUB" selected>RUB - Российский рубль</option>
                                            @foreach($currency as $curItem)
                                                <option value="{{$curItem->currency}}">{{$curItem->currency}} - {{$curItem->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div><!-- END цена и валюта -->



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">META данные товара</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="h1">Заголовок H1</label>
                            <input type="text" class="form-control" id="h1" name="h1" value="{{ old('h1') }}" placeholder="Заголовок страницы товара...">
                        </div>

                        <div class="form-group">
                            <label for="meta_title">META Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="CEO заголовок страницы товара...">
                        </div>

                        <div class="form-group">
                            <label for="meta_description">META Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="CEO описание страницы товара...">{{ old('meta_description') }}</textarea>
                        </div>

                    </div>
                    <div class="card-footer clearfix"><p></p>
                    </div>
                </div><!-- END META  -->
            </div><!-- END ROW -->


            <div class="col-md-6 d-flex align-items-stretch"><!-- Новый ряд - правый -->

                <div class="card flex-fill">
                    <div class="card-header">
                        <h3 class="card-title">Характеристики товара</h3>
                    </div>
                     <div class="card-body">
                         @foreach ($attributes as $attr)
                         <div class="form-group row">
                            <label class="col-sm-6 col-form-label text-lg-right">{{$attr->name}}</label>
                                <div class="col-sm-6 d-flex align-items-center">
                                    <input type="hidden" name="properties[{{ $attr->id }}][name]" value="{{$attr->name}}">
                                    <input type="text" name="properties[{{ $attr->id }}][value]" value="{{ old('properties['.$attr->id.'][value]') }}" class="form-control" placeholder="Значение...">
                                </div>
                         </div>
                         @endforeach
                     </div>
                        <div class="card-footer clearfix"><p></p>
                     </div>
                </div><!-- END Характеристики товара -->

            </div><!-- END ROW col-6 -->
        </div><!-- END ROW col-12 -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Описание товара</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="prev">Краткое описание товара</label>
                            <textarea class="form-control" id="prev" name="prev" rows="3" placeholder="Краткое описание товара...">{{ old('prev') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание товара</label>
                            <textarea class="form-control" id="description" name="description" rows="7" placeholder="Описание товара...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer clearfix"><p></p></div>
                </div>
            </div>
        </div><!-- END ROW col-12 -->
        <div class="text-right  mt-3 mb-5 mr-5"><button type="submit" class="btn-lg btn-primary">Создать</button></div>
        </form>
    </div>

@endsection
