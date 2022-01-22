@extends('layouts.admin')
@section('title')
    Список новостей
@endsection
@section('header')

    <h2 class="h2">Список новостей </h2>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a href="{{route('admin.news.create')}}"
               type="button" class="btn btn-sm btn-outline-secondary">Добавить новость</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
    </div>
    {{--<x-alert type="success" message="Успех! Новость добавлена"></x-alert>
    <x-alert type="warning" message="Предупреждение!"></x-alert>
    <x-alert type="danger" message="Критическая ошибка!"></x-alert>
    --}}
@endsection
