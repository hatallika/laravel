@extends('layouts.main')
@section('title')
    Список новостей @parent
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Список новостей

                @isset($category)
                    - {{$category}}
                @endisset
            </h1>
        </div>
    </div>
@endsection

@section('content')
    {{-- comment --}}

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

        @forelse($news as $item)

            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                    <div class="card-body">
                        <div class="card-header">
                            <strong><a href="{{route("news.show",['id' => $item['id']])}}">
                                    {{$item['title']}}
                                </a></strong>
                        </div>
                        <p class="card-text"> {!! $item['description'] !!} </p>
                        <div>Автор: {{$item['author']}}</div>
                        <div>Категория: {{$item['category']}}</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Подробнее</button>

                            </div>
                            <small class="text-muted">{{now('Europe/Moscow')}}</small>
                        </div>
                    </div>
                </div>
            </div>


        @empty
            <h2>Нет новостей</h2>
        @endforelse
</div>
@endsection
@push('up')
    <p class="float-end mb-1">
        <a href="#">Вверх</a>
    </p>
@endpush

