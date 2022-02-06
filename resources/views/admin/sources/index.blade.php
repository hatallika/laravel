@extends('layouts.admin')
@section('title')
    Список источников загрузки
@endsection
@section('header')

    <h2 class="h2">Список источников загрузки </h2>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a href="{{route('admin.sources.create')}}"
               type="button" class="btn btn-sm btn-outline-secondary">Добавить источник</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Заголовок</th>
                <th>Активность</th>
                <th>Описание</th>
                <th>Источник</th>
                <th>Опции</th>
            </tr>
            </thead>
            <tbody>

            @forelse($sources as $source)

                <tr>
                    <td>{{$source->id}}</td>
                    <td>{{$source->title}}</td>
                    <td>{{$source->active}}</td>
                    <td>{{$source->description}}</td>
                    <td>{{$source->url}}</td>
                    <td>
                        <a href="{{route('admin.sources.edit', ['source' => $source]) }}">Ред.</a>&nbsp;
                        {{--<a href="javascript:;" style="color:red;">Уд.</a> --}}
                        <form method="post" action="{{ route('admin.sources.destroy', ['source' => $source]) }}">
                            <!-- here the '1' is the id of the post which you want to delete -->

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit">Удалить</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Записей нет</td></tr>
            @endforelse
            </tbody>


        </table>

    </div>

    {{--<x-alert type="success" message="Успех! Новость добавлена"></x-alert>
    <x-alert type="warning" message="Предупреждение!"></x-alert>
    <x-alert type="danger" message="Критическая ошибка!"></x-alert>
    --}}
@endsection

