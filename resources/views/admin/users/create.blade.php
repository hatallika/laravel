
@extends('layouts.admin')
@section('title')
    Добавить пользователя
@endsection
@section('header')
    <h2 class="h2">Добавить пользователя </h2>
@endsection
@section('content')

    @include('inc.message')

    <form method="POST" action="{{route("admin.users.store") }}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

        <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" }>
        </div>

        <div class="form-group">
            <label for="is_admin">Права</label>
            <select class="form-control text-uppercase" name="is_admin" id="is_admin">
                <option value="1" @if(old('is_admin')==='1') selected @endif>Администратор</option>
                <option value="0" @if(old('status')==='0') selected @endif>Пользователь</option>
            </select>
        </div>


        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" {{old('password')}}>

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
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" {{old('password-confirm')}}>
            </div>
        </div>


        <input type="submit" class="btn btn-success float-end mt-2" value="Создать">
    </form>

@endsection

