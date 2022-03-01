@extends('layouts.main-layout')

@section('title')
    {{-- {{ $apartment -> title }} --}}
@endsection


@section('content')

    <h2>
        {{ $apartment -> title }}
    </h2>

    <p>
        {{ $apartment -> description }}
    </p>

    <span class="mx-2">
        Stanze: {{ $apartment -> rooms }}
    </span>
    <span class="mx-2">
        Letti: {{ $apartment -> beds }}
    </span>
    <span class="mx-2">
        Bagni: {{ $apartment -> bathrooms }}
    </span>
    <span class="mx-2">
        Metri quadri: {{ $apartment -> sq }}
    </span>

    <img src="{{ $apartment -> image }}" alt="non trovo immagine">

    <div>
        {{ $apartment -> address }}
    </div>
    
    <a href="{{ route('home') }}">BACK</a>
    
@endsection