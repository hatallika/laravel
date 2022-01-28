@extends('layouts.admin')
@section('title')
    Редактировать новость
@endsection
@section('header')
    <h2 class="h2">Редактировать новость </h2>
@endsection
@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif

    <form method="POST" action="{{route("admin.news.update", ['news' => $news]) }}">
        {{--<input type="hidden" name="_token" value="{{csrf_token()}}"/>--}}
        @csrf
        @method('put')

        <div class="form-group">
            <label for="title">Заголовок новости</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
        </div>

        <div class="form-group">
            <label for="author">Автор</label>
            <input type="text" class="form-control" id="author" name="author" value="{{$news->author}}" }>
        </div>

        <div class="form-group">
            <label for="status">Статус новости</label>
            <select class="form-control text-uppercase" name="status" id="status">
                <option value="draft" @if($news->status === 'draft') selected @endif>draft</option>
                <option value="active" @if($news->status === 'active') selected @endif>active</option>
                <option value="blocked" @if($news->status ==='blocked') selected @endif>blocked</option>
            </select>

        </div>

        <div class="form-group">
            <label for="description">Описание новости</label>
            <textarea class="form-control" name="description" id="description" cols="30"
                      rows="3">{!! $news->description !!}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Категория новости</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($categories as $item)

                    <option value="{{$item->id}}" @if($news->category_id == $item->id) selected @endif>{{$item->title}}</option>

                @endforeach
            </select>
        </div>



        <input type="submit" class="btn btn-success float-end mt-2" value="Сохранить">
    </form>

@endsection
