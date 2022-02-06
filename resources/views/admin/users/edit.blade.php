
@extends('layouts.admin')
@section('title')
    Редактировать пользователя
@endsection
@section('header')
    <h2 class="h2">Редактировать пользователя </h2>
@endsection
@section('content')

    @include('inc.message')

    <form method="POST" action="{{route("admin.users.update", ['user' => $user]) }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"  value="{{$user->email}}" }>
        </div>

        <div class="form-group">
            <label for="is_admin">Права</label>
            <select class="form-control text-uppercase" name="is_admin" id="is_admin">
                <option value="1" @if($user->is_admin) selected @endif>Администратор</option>
                <option value="0" @if(!$user->is_admin) selected @endif>Пользователь</option>
            </select>
        </div>


        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Повторите пароль') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
            </div>
        </div>


        <input type="submit" class="btn btn-success float-end mt-2" value="Сохранить">
    </form>

@endsection

