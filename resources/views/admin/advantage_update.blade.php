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

            <form role="form" action="{{ route('advantages.update', $advantage->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <a href="{{route('advantages.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Данные торгового преимущества</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active" value="{{$advantage->active}}" type="checkbox" @if($advantage->active) checked @endif  onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Элемент активен</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control @error('sort') is-invalid @enderror" id="sort" name="sort" value="{{$advantage->sort}}">
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="name">Название, заголовок преимущества</label><code>*</code>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $advantage->name }}" required>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label  class="mb-0">Иконка</label>
                                        <div class="input-group">
                                            <div class="advantage_admin_icon {{ $advantage->icon }}" id="advantageIcon"></div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="icon">Выбор иконки</label>
                                        <select name="icon" class="form-control" id="choiceIcon">
                                            <option value="thumb_up" {{ ($advantage->icon == 'thumb_up')? 'selected' : ''}}>Ништяк</option>
                                            <option value="sale" {{ ($advantage->icon == 'sale')? 'selected' : ''}}>Sale</option>
                                            <option value="new" {{ ($advantage->icon == 'new')? 'selected' : ''}}>Новинка</option>
                                            <option value="persent" {{ ($advantage->icon == 'persent')? 'selected' : ''}}>Проценты</option>
                                            <option value="hit" {{ ($advantage->icon == 'hit')? 'selected' : ''}}>Хит</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="text">Текст преимущества</label>
                                    <textarea class="form-control" name="text" rows="3">{{ $advantage->text }}</textarea>
                                </div>
                            </div>

                        </div><!-- ./Card row -->
                    </div><!-- ./CARD-BODY -->
                    <div class="card-footer clearfix">
                            <p></p>
                    </div>
               </div> <!-- ./card -->
             </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Изменить</button>
             </div>
        </form>
    </div>
@endsection

