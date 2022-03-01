@extends('layouts.main-layout')

@section('title')
    Modifica appartamento
@endsection


@section('content')
    <form 
    enctype="multipart/form-data" 
    action="{{ route('apartment.update', $apartment ->id) }}" 
    method="POST">

        @method('POST')
        @csrf

        <h1>Modifica appartamento</h1>

        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Titolo" value="{{$apartment -> title}}"> <br>
        
        <label for="description">Description:</label>
        <input type="text" name="description" placeholder="Descrizione" value="{{$apartment -> description}}"><br>
        
        <label for="rooms">Rooms:</label>
        <input type="number" name="rooms"  min="0" value="{{$apartment -> rooms}}"><br>

        <label for="beds">Beds:</label>
        <input type="number" name="beds"  min="0" value="{{$apartment -> beds}}"><br>
        
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" name="bathrooms"  min="0" value="{{$apartment -> bathrooms}}"><br>
        
        <label for="sq">Square:</label>
        <input type="number" name="sq"  min="0" value="{{$apartment -> sq}}"><br>

        <label for="images">Images:</label>
        <input type="file" name="images"><br>

        <label for="address">Address:</label>
        <input type="text" name="address" placeholder="Address" value="{{$apartment -> address}}"><br>

        <h3>Servizi</h3>

        @foreach ($services as $service)
            <input type="checkbox" name="services[]" value="{{ $service -> id }}"
            
            @foreach ($apartment -> services as $apartmentService)
                @if ($service -> id == $apartmentService -> id)
                    checked
                @endif
            @endforeach
            
            > {{ $service -> name }}<br>
        @endforeach <br>

        <div class="form-check">
            
            
        </div>



        <input type="submit" value="UPDATE">

    </form>

    <a href="{{ route('home') }}">BACK</a>
@endsection