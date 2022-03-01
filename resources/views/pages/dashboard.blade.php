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
    @endauth
@endsection