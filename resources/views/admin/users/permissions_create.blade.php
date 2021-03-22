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

            <form role="form" action="{{ route('permissions.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                 <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Намиенование нового разрешения</h3>
                    </div>

                        <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="name">Наименование разрешения</label><code>*</code>
                                    <input type="text" id="CreateName" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Наименование разршения" required>
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
@endsection

