@extends('layouts.admin')
@section('title')
    Редактировать Источник
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
        <form method="post" action="{{route("admin.sources.update", ['source' => $source]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Название источника</label>
                <input type="text" class="form-control" id="title" name="title" requiredс value="{{$source->title}}">
            </div>
            <div class="form-group">
                <label for="description">Описание источника</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="3">{!! $source->description !!}</textarea>
            </div>

            <div class="form-group">
                <label for="url">Url</label>
                <input type="text" class="form-control" id="url" name="url" value="{{$source->url}}" required>
            </div>

            <button type="submit" class="btn btn-success float-end mt-2">Сохранить</button>

        </form>
    </div>
@endsection

