@extends('layouts.main-layout')

@section('title')
    Dashboard
@endsection

@section('content')

    @auth
        <h2>Ciao {{ Auth::user() -> name }}!</h2>

        <h3>{{ Auth::user() -> id }}</h3>
        <a class="btn btn-secondary" href="{{ route('logout') }}">LOGOUT</a>

        <apartment-user-list></apartment-user-list>

        <a href="{{ route('apartment.create') }}">NEW APARTMENT</a>

        <h2>Messages Recived</h2>

        @foreach ($messagesArray as $message)
            <h4>{{$message -> sender}}</h4>
            <p>{{$message -> text}}</p>
            <hr><hr>
        @endforeach

    @endauth
@endsection