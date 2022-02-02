@extends('layouts.admin')
@section('title')
    Добавить категорию
@endsection
@section('header')
    <h1 class="h2">Добавить категорию</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    {{-- Форма --}}
    <div>
        @include('inc.message')
        <form method="post" action="{{route("admin.categories.store") }}">
            @csrf
            <div class="form-group">
                <label for="title">Название категории</label>
                <input type="text" class="form-control" id="title" name="title">
                @error('title') <strong style="color:red;">{{$message}}</strong>@enderror
            </div>
            <div class="form-group">
                <label for="description">Описание категории</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success float-end mt-2">Сохранить</button>

        </form>
    </div>
@endsection

