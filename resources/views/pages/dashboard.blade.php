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
        <div class="d-flex flex-column-reverse">
            @foreach ($obj as $item)
                <div>
                    <h4>{{$item -> message -> sender}} --- {{$item -> apartment -> title}}</h4>
                    <p>{{$item -> message -> text}}</p>
                    <h6>inviato il {{$item -> message -> created_at -> format ('d/m/Y -- h:i')}}</h6>
                </div>
            @endforeach
        </div>
    @endauth
@endsection