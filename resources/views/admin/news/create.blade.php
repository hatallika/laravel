@extends('layouts.admin')
@section('title')
    Добавить новость
@endsection
@section('header')
    <h2 class="h2">Добавить новость </h2>
@endsection
@section('content')

    @include('inc.message')

    <form method="POST" action="{{route("admin.news.store") }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

        <div class="form-group">
            <label for="title">Заголовок новости</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
        </div>

        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" id="author" name="author" value="{{old('author')}}" }>
        </div>

        <div class="form-group">
            <label for="status">Статус новости</label>
            <select class="form-control text-uppercase" name="status" id="status">
                <option value="draft" @if(old('status')==='draft') selected @endif>draft</option>
                <option value="active" @if(old('status')==='active') selected @endif>active</option>
                <option value="blocked" @if(old('status')==='blocked') selected @endif>blocked</option>
            </select>

        </div>

        <div class="form-group">
            <label for="description">Описание новости</label>
            <textarea class="form-control" name="description" id="description" cols="30"
                      rows="3">{!!old('description')!!}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Категория новости</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($categories as $category)

                    <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>{{$category->title}} </option>

                @endforeach
            </select>
        </div>

        <input type="submit" class="btn btn-success float-end mt-2" value="Создать">
    </form>

@endsection
