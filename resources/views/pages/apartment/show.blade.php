@extends('layouts.main-layout')

@section('title')
    {{ $apartment -> title }}
@endsection


@section('content')

    <div class="container">
        {{-- TITOLO APPARTAMENTO E LOCALITA --}}
        <div class="general_info">
            <h3>
                {{ $apartment -> title }}
            </h3>
            <h5>
                {{ $apartment -> address }}
            </h5>
        </div>
        {{-- SHOW APPARTAMENTO --}}
        <div class="show_apartment w-100 h-100">
            {{-- @if ($apartment->images)   --}}
                {{-- <img src="{{asset('storage/assets/'. $apartment->images)}}" alt="{{$apartment -> title}}"> --}}
                <img class="w-100" src="{{ asset('storage/assets/appartamento.jpg') }}" alt="">
            {{-- @endif --}}
            <p>
                {{ $apartment -> description }}
            </p>
        </div>
        {{-- SERVIZI DISPONIBILI APPARTAMENTO --}}
        <div class="services">
            <h3>Cosa troverai</h3>
        </div>


    
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
    

    

    

    
        @if ($apartment -> longitude != '')
        <apartment-map :lng="{{ $apartment -> longitude }}" :lat="{{ $apartment -> latitude }}"></apartment-map>
        @endif
        
        <a href="{{ route('home') }}">BACK</a>

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


   
    
@endsection