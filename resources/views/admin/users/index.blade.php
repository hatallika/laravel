@extends('layouts.admin')
@section('title')
    Список пользователей
@endsection
@section('header')

    <h2 class="h2">Список пользователей </h2>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a href="{{route('admin.users.create')}}"
               type="button" class="btn btn-sm btn-outline-secondary">Добавить пользователя</a>
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
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Последняя авториизация</th>
                <th>Опции</th>
            </tr>
            </thead>
            <tbody>

            @forelse($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{($user->is_admin) ? 'Администратор' : 'Пользователь' }}</td>
                    <td>{{$user->last_login_at}}</td>
                    <td>
                        <a href="{{route('admin.users.edit', ['user' => $user]) }}">Ред.</a>&nbsp;
                        <a href="javascript:;" class="delete" rel="{{$user->id}}" style="color:red;">Уд.</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Записей нет</td></tr>
            @endforelse
            </tbody>


        </table>

    </div>

@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (){
            const el = document.querySelectorAll(".delete");
            el.forEach(function(e, k) {
                e.addEventListener('click', function (){
                    const id = e.getAttribute("rel");
                    if(confirm("Подтверждаете удаление записи с #ID=" + id + "?")){
                        send('/admin/users/' + id).then(()=>{
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
