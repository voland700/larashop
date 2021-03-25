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
                        <h3 class="card-title">Элементы преимуществ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('slider_icons.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">N</th>
                                <th>Наименование</th>
                                <th style="width: 20px">Активность</th>
                                <th style="width: 20px">Сортировка</th>
                                <th style="width: 120px">Редактировать</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($icons as $icon)
                            <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td>{{$icon->name ?? ''}}</td>
                                <td style="text-align: center">{!!($icon->active ==1) ? '<i class="text-success far fa-check-circle"></i>' : '<i class="text-danger fas fa-ban"></i>'!!}</td>
                                <td style="text-align: center">{{$icon->sort}}</td>
                                <td>
                                    <a href="{{ route('slider_icons.edit', $icon->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('slider_icons.destroy', $icon->id) }}" method="POST" onsubmit="return confirm('Вы уверены в необходимости удаления?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
