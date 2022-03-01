@extends('layouts.admin')
@section('title')
    Редактировать категорию
@endsection
@section('header')
    <h1 class="h2">Редактировать категорию</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    {{-- Форма --}}
    <div>
        <form method="post" action="{{route("admin.categories.update", ['category' => $category]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Название категории</label>
                <input type="text" class="form-control" id="title" name="title" requiredс value="{{$category->title}}">
                @error('title') <strong style="color:red;">{{$message}}</strong>@enderror

            </div>
            <div class="form-group">
                <label for="description">Описание категории</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="3">{!! $category->description !!}</textarea>
                @error('description') <strong style="color:red;">{{$message}}</strong>@enderror
            </div>
            <button type="submit" class="btn btn-success float-end mt-2">Сохранить</button>

        </form>
    </div>
@endsection

