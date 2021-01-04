@extends('layouts.auth')
@section('title')
<title>{{ config('app.name', 'Laravel') }}</title>
@endsection
@section('content')
<div class="uk-flex uk-flex-center uk-flex-middle" style="min-height: calc(100vh - 161px);">
    <div class="">
        <h1 class="uk-heading-medium uk-text-muted uk-text-uppercase">{{ config('app.name', 'Laravel') }}</h1>
        @if (Route::has('login'))
        @guest
        <ul class="uk-subnav uk-flex-center">
            <li><a href="{{ route('login') }}">Вход</a></li>
            @if (Route::has('register'))
            <li><a href="{{ route('register') }}">Регистрация</a></li>
            @endif
        </ul>
        @endguest
        @endif
        @auth
        <form action="{{ route('logout') }}" method="POST" class="uk-flex uk-flex-center">
            @csrf
            <button type="submit" class="uk-button uk-button-primary">Logout</button>
        </form>
        <div style="display: flex; justify-content: center; margin: 10px 0;">
                <a class="uk-button uk-button-primary" href="/admin">Админ</a>
         </div>
        @endauth
    </div>
</div>
@endsection
