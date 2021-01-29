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

            <form role="form" action="{{ route('discounts.store') }}" method="post" id="DiscountsForm" enctype="multipart/form-data">
                @csrf
                <div class="row">


                 <div class="col-md-12">
                    <div class="card">



                        <div class="card-header">
                            <h3 class="card-title">Данные скидки</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" name="active" id="active"value="1" type="checkbox" checked="" onchange="checkboxToggle()">
                                    <label class="form-check-label" for="active">Скидка активна</label>
                                </div>
                             </div>

                            <div class="form-group col-1">
                                <label for="sort">Сортировка</label>
                                <input type="text" class="form-control" id="sort" name="sort" value="100" placeholder="100">
                            </div>


                            <div class="form-group col-md-4">
                                <label for="name">Наименование скидки</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="CreateName" name="name" value="" placeholder="Наименование категории">
                            </div>

                            <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="type">Тип скидки</label>
                                    <select class="form-control">
                                        <option value="percent">В процентах</option>
                                        <option value="fixed">Фиксированная сумма</option>
                                        <option value="cost">Установить цену на товар</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="value">Значение скидки</label>
                                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="" placeholder="Ввидите сумму">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group  col-md-2">
                                    <label for="type">Условия скидки</label>
                                    <select id="choiceGoods" class="form-control">
                                        <option value="goods">Скидка на товары</option>
                                        <option value="category">Скидка на категорию</option>
                                    </select>
                                </div>
                                <div class="form-group  col-md-2">
                                    <label for="type">Выбрать</label>
                                    <div class="">
                                        <button type="button" class="btn btn-default" onclick="return ChangeGoods(this);">Middle</button>
                                    </div>
                                </diw>
                            </div>

                            </div>
                        </div>

                        <ul id="GoodsList">
                            <li class="d_list-item">Печь-камин № 11<span class="d_id">(11)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 8<span class="d_id">(8)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 9<span class="d_id">(9)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 7<span class="d_id">(7)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 5<span class="d_id">(5)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 6<span class="d_id">(6)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 3<span class="d_id">(3)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 2<span class="d_id">(2)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин №1<span class="d_id">(1)</span><span class="d_btn-del">×</span></li><li class="d_list-item">Печь-камин № 4<span class="d_id">(4)</span><span class="d_btn-del">×</span></li>
                        </ul>










                        <div class="card-footer clearfix">
                            <p></p>
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-primary mt-3 mb-5 ml-3">Создать</button>
             </div>
        </form>
    </div>





    <div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Extra Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>








@endsection

