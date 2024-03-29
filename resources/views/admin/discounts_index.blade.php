@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Скидки на товары каталога</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('discounts.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                        <table class="table table-bordered">
                            <thead>
                                 <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Название категории</th>

                                    <th style="width: 20px">Значение</th>
                                    <th  style="width: 10px">Активность</th>
                                    <th  style="width: 40px">Редактировать</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            function showValue($kind, $value){
                                if($kind == 'percent'){
                                    return $value.'%';
                                } elseif ($kind == 'fixed'){
                                    return '- '.$value;
                                }elseif ($kind == 'cost') {
                                    return '= '.$value;
                                } else {
                                    return false;
                                }
                            }
                            function isActive($active){
                            if($active) {
                            return '<i class="text-success far fa-check-circle"></i>';
                            } else {
                            return '<i class="text-danger fas fa-ban"></i>';
                            }}
                            @endphp
                            @forelse ($discounts as $discount)
                                <th>{{ $discount->id }}</th>
                                <td><a href="{{route("discounts.edit", $discount->id)}}">{{ $discount->name }}</a></td>
                                <td style="text-align: center">{!!  showValue($discount->type, $discount->value) !!}</td>
                                <td style="text-align: center">{!! isActive($discount->active) !!}</td>
                                <td class="text-center">
                                    <a href="{{route("discounts.edit", $discount->id)}}" class="btn btn-info mr-1"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{route("discounts.destroy", $discount->id)}}" data-name="Первая главная категория" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                </tr>
                             @empty
                                <p>Нет скидок</p>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer clearfix">
                        {{ $discounts->links() }}
                    </div>
                </div>
            </div>
        </div>
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
