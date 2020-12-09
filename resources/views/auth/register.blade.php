@extends('layouts.auth')

@section('title')
<title>Регистрация</title>
@endsection
@section('content')
<div class="uk-flex uk-flex-center">
    <div class="uk-card uk-card-default uk-box-shadow-large uk-width-xlarge uk-margin-bottom">
        <div class="uk-card-body">
            <h3 class="uk-heading-divider">Регистрация</h3>
            <form action="{{ route('register') }}" method="POST" class="uk-form-horizontal">
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="name">Имя</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="uk-text-danger uk-text-small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
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
                    <label class="uk-form-label" for="password-confirm">Повторить пароль</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="password-confirm" name="password_confirmation" type="password" value="{{ old('password-confirm') }}" required autocomplete="new-password">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls">
                        <button type="submit" class="uk-button uk-button-primary">
                            Зарегистрироваться
                        </button>
                    </div>
                </div>
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
