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

            <form role="form" action="{{ route('sliders.store') }}" method="post" id="SlidersForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <a href="{{route('sliders.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Данные слайда</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Слайд активен</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="50" placeholder="50">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название, заголовок слйда</label><code>*</code>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Наименование скидки" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="img">Основное изображение - фон</label><code>*</code>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="background" value="{{ old('background') }}" class="custom-file-input @error('background') is-invalid @enderror" id="background">
                                                <label class="custom-file-label" for="background">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="img">Доплнительное Изображение слайда</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="img" value="{{ old('img') }}" class="custom-file-input @error('img') is-invalid @enderror" id="img">
                                                <label class="custom-file-label" for="img">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="color">Цвет текста</label>
                                        <select name="color" class="form-control">
                                            <option value="txt-black">Темный</option>
                                            <option value="txt-white">Светлый</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="link">Сылка для перехода</label>
                                    <input type="text" class="form-control  name="link" value="{{ old('link') }}" placeholder="Укажите ссылку">
                                </div>


                                <div class="form-group">
                                    <label for="text">Текст на слайде</label>
                                    <textarea class="form-control" name="text" rows="3" placeholder="Текст на слайде">{{ old('text') }}</textarea>
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
    <div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Выбор товаров для скидок</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

        <div class="modal fade" id="modalCategory" style="display: none; padding-right: 17px;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Выбор категорий каталога</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBodyCategories">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnChoiceCategories">Выбрать</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>








@endsection

