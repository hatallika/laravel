@extends('layouts.main')
@section('title')
    Категории новостей @parent
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Категории новостей</h1>
        </div>
    </div>
@endsection

@section('content')

    <ul class="nav flex-column">

       @foreach ($categories as $category)
            <li class="nav-item"><a class="nav-link" href="{{route("news.category",['id_category' => $category->id])}}">
                    {{$category->title}}</a>
            </li>
        @endforeach
    </ul>
@endsection

