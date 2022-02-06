@extends('layouts.main')
@section('title')
    Аккаунт {{Auth::user()->name}}
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Персональная страница
            </h1>
        </div>
    </div>
@endsection

@section('content')
    @include('inc.message')
    <h2>Добро пожаловать, {{ Auth::user()->name }}</h2>
    <br>
    @if(Auth::user()->is_admin)
    <a href="{{route('admin.index')}}" style="color: red">Перейти в админку</a>
    <br>
    @endif
    <a href="{{route('account.logout')}}">Выход</a>
    <br>

<div>
    Имя: {{$user->name}} <br>
    E-mail: {{$user->email}} <br>
    Последняя авторизация: {{$user->last_login_at}}<br>
</div>
    <a href="{{route('profile.edit', ['profile' => $user->id]) }}">Редактировать профиль</a>&nbsp;
@endsection





