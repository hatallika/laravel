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
       @foreach ($categories as $idx_category => $category)
            <li class="nav-item"><a class="nav-link" href="{{route("news.category",['idx_category' => $idx_category])}}">
                    {{$category}}</a>
            </li>
        @endforeach
    </ul>
@endsection

