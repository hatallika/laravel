@extends('layouts.main')
@section('title')
   О сайте @parent
@endsection
@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Добро пожаловать!</h1>
                <p class="lead text-muted">Вы находитесь на сайте агрегаторе новостей. <br>
                    Получайте информацию из разных источников в одном месте </p>
                <p>
                    <a href="{{route('news.index')}}" class="btn btn-primary my-2">Новости</a>
                    <a href="{{route('categories')}}" class="btn btn-secondary my-2">Категории</a>
                </p>
            </div>
        </div>
    </section>
@endsection

