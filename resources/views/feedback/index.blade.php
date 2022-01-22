@extends('layouts.main')
@section('title')
    Отзывы @parent
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Отзывы пользователей</h1>
        </div>
    </div>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a href="{{route('feedback.create')}}"
               type="button" class="btn btn-sm btn-outline-secondary">Добавить отзыв</a>
        </div>


@endsection
@section('content')

    @isset($feedback)
        Имя пользователя: {{$feedback['name']}} <br>
        Отзыв:  {{$feedback['comment']}}
                @else <p>Здесь будут отзывы пользователей</p>
    @endisset
@endsection
