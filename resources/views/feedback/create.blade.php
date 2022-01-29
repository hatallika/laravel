@extends('layouts.main')
@section('title')
    Добавить отзыв @parent
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Добавить отзыв</h1>
        </div>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <div>
        <form method="post" action="{{route("feedback.store") }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя пользователя</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="comment">Отзыв</label>
                <textarea class="form-control" name="comment" id="comment" cols="30" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success float-end mt-2">Отправить</button>

        </form>
    </div>
@endsection
