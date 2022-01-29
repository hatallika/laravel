@extends('layouts.admin')
@section('title')
    Список категорий
@endsection
@section('header')
    <h1 class="h2">Список категорий</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a href="{{route('admin.categories.create')}}"
               type="button" class="btn btn-sm btn-outline-secondary">Добавить категорию</a>
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
{{-- @push('js')
    <script>
        alert("Hello, categories")
    </script>
@endpush --}}
