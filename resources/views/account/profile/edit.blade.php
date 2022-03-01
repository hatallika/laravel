@extends('layouts.main')
@section('title')
    Редактировать профиль
@endsection
@section('header')
    <h2 class="h2">Редактировать профиль </h2>
@endsection
@section('content')
    <div>

        @include('inc.message')

        <form method="POST" action="{{route("profile.update", ['profile' => $profile]) }}">
            {{--<input type="hidden" name="_token" value="{{csrf_token()}}"/>--}}
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="title" name="name" value="{{$profile->name}}">
                @error('title') <strong style="color: red;">{{$message}}</strong>@enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="author" name="email" value="{{$profile->email}}" }>
                @error('author') <strong style="color: red;">{{$message}}</strong>@enderror
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
    </div>
@endsection

