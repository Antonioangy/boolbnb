@extends('layouts.main-layout')

@section('title')
    {{ $apartment -> title }}
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

    @if ($apartment->images)  
    <img src="{{asset('storage/assets/'. $apartment->images)}}" alt="{{$apartment -> title}}">
    @endif

    <div>
        {{ $apartment -> address }}
    </div>

    <div>
        <h3>Invia una mail al proprietario</h3>
        <form action="{{ route('apartment.message_send', $apartment -> id) }}" method="POST">
            @method('POST')
            @csrf

            <div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>

            <input type="email" name="sender" class="form-control" id="exampleFormControlInput1" placeholder="insert your email"
            @if (Auth::user())
            value="{{$user -> email}}"
            @endif>
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Example textarea</label>
              <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <input type="submit" value="Invia" class="btn btn-success">
        </form>

    </div>

    <apartment-map :lng="{{ $apartment -> longitude }}" :lat="{{ $apartment -> latitude }}"></apartment-map>
    
    <a href="{{ route('home') }}">BACK</a>
    
@endsection