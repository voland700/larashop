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

            <form role="form" action="{{ route('brands.store') }}" method="post" id="brandsForm" enctype="multipart/form-data">
                @csrf
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
                                        <input class="form-check-input" name="active" id="active" value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Производитель активен</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="slider" id="slider" value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                        <label class="form-check-label" for="slider">В слайдере на главной</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="100" placeholder="100">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="name">Название призводителя</label><code>*</code>
                                    <input type="text" id="CreateName" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Название бренда" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Символьный код</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="CreateSlug" name="slug" value="{{ old('slug') }}" placeholder="manufacture">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="img">Изображение логотипа</label><code>*</code>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" value="{{ old('img') }}" class="custom-file-input @error('img') is-invalid @enderror">
                                            <label class="custom-file-label" for="img">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-3 mt-5">Мета данные производителя</h5>

                                <div class="form-group col-md-12">
                                    <label for="h1">Заголовок H1</label>
                                    <input type="text" id="h1" class="form-control" name="h1" value="{{ old('h1') }}" placeholder="Заголовок H1">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_title">meta title</label>
                                    <input type="text" id="meta_title" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Заголовок окна браузера">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="meta_keys">meta keywords</label>
                                    <input type="text" id="meta_keys" class="form-control" name="meta_keys" value="{{ old('meta_keys') }}" placeholder="Ключевые слова">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">meta discription</label>
                                    <textarea class="form-control" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                                </div>

                                <div class="form-group mt-5">
                                    <label for="description">Описание производителя</label>
                                    <textarea class="form-control" name="description" rows="7">{{ old('description') }}</textarea>
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

