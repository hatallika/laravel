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
        @include('inc.message')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Заголовок</th>
                    <th>Статус</th>
                    <th>Автор</th>
                    <th>Содержание</th>
                    <th>Категория</th>
                    <th>Опции</th>
                </tr>
            </thead>
            <tbody>

            @forelse($newsList as $news)

                <tr>
                    <td>{{$news->id}}</td>
                    <td>{{$news->title}}</td>
                    <td>{{$news->status}}</td>
                    <td>{{$news->author}}</td>
                    <td>{{$news->description}}</td>
                    <td>{{optional($news->category)->title}}</td>
                    <td>
                        <a href="{{route('admin.news.edit', ['news' => $news]) }}">Ред.</a>&nbsp;
                        <a href="javascript:;" class="delete" rel="{{$news->id}}" style="color:red;">Уд.</a>
                    {{--    <form method="post" action="{{ route('admin.news.destroy', ['news' => $news]) }}">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit">Удалить</button>
                        </form>
                    --}}
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Записей нет</td></tr>
            @endforelse
            </tbody>


        </table>

    </div>
    {{$newsList->links()}}
    {{--<x-alert type="success" message="Успех! Новость добавлена"></x-alert>
    <x-alert type="warning" message="Предупреждение!"></x-alert>
    <x-alert type="danger" message="Критическая ошибка!"></x-alert>
    --}}
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (){
            const el = document.querySelectorAll(".delete");
            el.forEach(function(e, k) {
                e.addEventListener('click', function (){
                    const id = e.getAttribute("rel");
                    if(confirm("Подтверждаете удаление записи с #ID=" + id + "?")){
                        send('/admin/news/' + id).then(()=>{
                            location.reload();
                        });
                    }
                });

            });
        });

        async function send(url) {
            let response = await fetch(url,  {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            let result = await response.json();
            return result.ok;

        }
    </script>
@endpush
