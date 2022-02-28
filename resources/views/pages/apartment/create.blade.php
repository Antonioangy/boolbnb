@extends('layouts.main-layout')

@section('title')
    Nuovo appartamento
@endsection


@section('content')
    <form 
    enctype="multipart/form-data" 
    action="{{ route('apartment.store') }}" 
    method="POST">

        @method('POST')
        @csrf

        
        <input type="submit" value="Create">

    </form>

    <a href="{{ route('home') }}">BACK</a>
@endsection