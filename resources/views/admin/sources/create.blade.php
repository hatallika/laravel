@extends('layouts.admin')
@section('title')
    Добавить источник
@endsection
@section('header')
    <h1 class="h2">Добавить ичточник</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
        </div>
    </div>
@endsection
@section('content')
    {{-- Форма --}}
    <div>
        <form method="post" action="{{route("admin.sources.store") }}">
            @csrf
            <div class="form-group">
                <label for="title">Название источника</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Введите название">
                @error('title') <span style="color: red">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label for="description">Описание источника</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="3" placeholder="Введите описание источника"></textarea>
                @error('description') <span style="color: red">{{$message}}</span> @enderror
            </div>
            <div class="form-group">
                <label for="url">Ссылка на источник</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="http://">
                @error('url') <span style="color: red">{{$message}}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success float-end mt-2">Добавить</button>

        </form>
    </div>
@endsection

