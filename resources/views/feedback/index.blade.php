@extends('layouts.main')
@section('title')
    Отзывы @parent
@endsection

@section('header')
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Отзывы пользователей</h1>
        </div>
    </div>

    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">

            <a href="{{route('feedback.create')}}"
               type="button" class="btn btn-sm btn-outline-secondary">Добавить отзыв</a>
        </div>


@endsection
@section('content')

   @include('inc.message')

    @isset($feedbackList)
                <div class="row">

        @foreach($feedbackList as $feedback)
                <div class="col-sm-6">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">{{$feedback->name}}</h5>
                            <p class="card-text">{{$feedback->comment}}</p>
                            <span>E-mail: {{$feedback->email}}</span>

                        </div>
                    </div>
                </div>
        @endforeach
        </div>


    @else <p>Здесь будут отзывы пользователей</p>
    @endisset
@endsection
