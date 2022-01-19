@extends('layouts.main')
@section('title')
    Заказать выгрузку @parent
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Заказать выгрузку из источника</h1>
        </div>
    </div>
@endsection

@section('content')
    @isset($errors)
    @if($errors->any())
        @foreach($errors->all() as $error)
            <x-alert type="danger" :message="$error"></x-alert>
        @endforeach
    @endif
    @endisset
    <div>
        <form method="post" action="{{route("order.store") }}">
            @csrf
            <div class="form-group">
                <label for="title">Имя</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">e-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="source">Укажите источник выгрузки данных</label>
                <input type="text" class="form-control" name="source" id="source" placeholder="http://"></input>
            </div>
            <button type="submit" class="btn btn-success float-end mt-2">Заказать выгрузку</button>

        </form>
    </div>
@endsection

