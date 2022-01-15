@extends('layouts.admin')
@section('title')
    Добавить новость
@endsection
@section('header')

    <h2 class="h2">Добавить новость </h2>
@endsection
@section('content')
<form method="POST" action="{{route("admin.news.store") }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />

        <input type="text" placeholder="Введите заголовок новости" name="title">
        <br>
        <input type="text" placeholder="Введите анонс" name="description">
        <br>
        Категория новостей: <br>
        <select>
            @foreach ($categories as $key => $category)

                <option value="{{$key}} ?>">{{$category}}</option>
            @endforeach
        </select>
        <input type="submit" value="Создать">
    </form>
@endsection
