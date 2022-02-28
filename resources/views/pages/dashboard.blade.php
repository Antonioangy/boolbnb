@extends('layouts.main-layout')

@section('title')
    Dashboard
@endsection

@section('content')

    @auth

        <h2>Ciao {{ Auth::user() -> name }}!</h2>
        <a class="btn btn-secondary" href="{{ route('logout') }}">LOGOUT</a>
    @endauth
@endsection