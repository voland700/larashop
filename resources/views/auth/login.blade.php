@extends('layouts.auth')

@section('title')
<title>Авторизация</title>
@endsection
@section('content')
<div class="uk-flex uk-flex-center">
    <div class="uk-card uk-card-default uk-box-shadow-large uk-width-xlarge uk-margin-bottom">
        <div class="uk-card-body">
            <h3 class="uk-heading-divider">Авторизация</h3>
            <form action="{{ route('login') }}" method="POST" class="uk-form-horizontal">
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
                    <label class="uk-form-label" for="password">Пароль</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="password" name="password" type="password" value="{{ old('password') }}" required autocomplete="new-password">
                        @error('password')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <label>
                            <input class="uk-checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить
                        </label>
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <button type="submit" class="uk-button uk-button-primary">
                            Войти
                        </button>
                    </div>
                </div>
                @if (Route::has('password.request'))
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <a href="{{ route('password.request') }}">Забыли пароль?</a>
                    </div>
                </div>
                @endif
                @if (Route::has('register'))
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <a href="{{ route('register') }}">Регистрация</a>
                    </div>
                </div>
                @endif
            </form>
        </div>    
    </div>    
</div>

@endsection