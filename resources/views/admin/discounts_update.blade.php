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

            <form role="form" action="{{ route('discounts.update', $discount->id) }}" method="post" id="DiscountsForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                 <div class="col-md-12">


                <div class="card">
                    <div class="card-header">
                        <a href="{{route('discounts.index')}}" class="float-left mr-2"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        <h3 class="card-title">Данные скидки</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" id="active"value="{{$discount->active}}" type="checkbox" @if($discount->active) checked @endif onchange="checkboxToggle()">
                                        <label class="form-check-label" for="active">Скидка активна</label>
                                    </div>
                                </div>

                                <div class="form-group col-1">
                                    <label for="sort">Сортировка</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="{{$discount->sort}}">
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="name">Наименование скидки</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$discount->name}}" required>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="type">Тип скидки</label>
                                        <select name="type" class="form-control">
                                            <option value="percent" @if($discount->type == 'percent') selected @endif>В процентах</option>
                                            <option value="fixed" @if($discount->type == 'fixed') selected @endif>Фиксированная сумма</option>
                                            <option value="cost" @if($discount->type == 'cost') selected @endif>Установить цену на товар</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="value">Значение скидки</label>
                                        <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{$discount->value}}" required pattern="[0-9]+" title="Размер скидки - целое число">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group  col-md-6">
                                        <label for="kind">Условия скидки</label>
                                        <select name="kind" id="choiceGoods" class="form-control">
                                            <option value="goods" @if($discount->kind == 'goods') selected @endif>Скидка на товары</option>
                                            <option value="category" @if($discount->kind == 'category') selected @endif>Скидка на категорию</option>
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="type">Выбрать</label>
                                        <div>
                                            <button type="button" class="btn btn-default" onclick="return ChangeUpdateGoods(this);">Выбор</button>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- ./COL-MD-6 -->
                            <div class="col-md-6">
                                <div class="container">
                                    <div class="discount-list" style="display: block">
                                        <h5>Список выбранных элементов каталога</h5>
                                        <ul class="d_list" id="GoodsList">
                                            @if(count($products))
                                            @foreach($products as $product)
                                                <li>{{$product->name}}<span class="d_id">({{$product->id}})</span><span class="d_btn-del" onclick="return RemoveElem(this);">×</span><input type="hidden" name="productsID[]" value="{{$product->id}}" class="d_input"></li>
                                            @endforeach
                                            @endif
                                            @if($categories)
                                                @foreach($categories as $category)
                                                     <li>{{$category->name}}<span class="d_id">({{$category->id}})</span><span class="d_btn-del" onclick="return RemoveElem(this);">×</span><input type="hidden" name="productsID[]" value="{{$category->id}}" class="d_input"></li>
                                                @endforeach
                                             @endif
                                        </ul>

                                        </ul>
                                    </div>
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
                        <button type="button" class="btn btn-primary" id="btnChoiceCategoriesUpdate">Выбрать</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>








@endsection

