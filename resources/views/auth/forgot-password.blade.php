@extends('layouts.auth')

@section('title')
<title>Сбросить пароль</title>
@endsection
@section('content')
<div class="uk-flex uk-flex-center">
    <div class="uk-card uk-card-default uk-box-shadow-large uk-width-xlarge uk-margin-bottom">
        <div class="uk-card-body">
            <h3 class="uk-heading-divider">Сбросить пароль</h3>
            @if (session('status'))
                <div class="uk-alert uk-alert-primary uk-margin-bottom">
                    На email оправлена ссылка для подтверждения.
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST" class="uk-form-horizontal">
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus="">
                        @error('email')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <button type="submit" class="uk-button uk-button-primary">
                            Отправить ссылку
                        </button>
                    </div>
                </div>
                @if (Route::has('register'))
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <a href="{{ route('register') }}">Регистрация</a>
                    </div>
                </div>
                @endif
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <a href="{{ route('login') }}">Авторизация</a>
                    </div>
                </div>
            </form>
        </div>    
    </div>    
</div>

@endsection