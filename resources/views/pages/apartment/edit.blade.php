@extends('layouts.main-layout')

@section('title')
    Modifica appartamento
@endsection

@section('content')
    <form 
    class="py-5"
    enctype="multipart/form-data" 
    action="{{ route('apartment.update', $apartment -> id )}}" 
    method="POST">

        @method('POST')
        @csrf

        <div class="insert-container container-xl bg-darkBlue d-flex flex-column p-5 rounded text-white">
            <h1 class="text-white">Modifica appartamento</h1>

            <label for="title">Titolo</label>
            <input type="text" name="title" placeholder="Titolo" class="p-2 h5" value="{{$apartment -> title}}"> 
            
            <label for="description">Descrizione</label>
            <textarea name="description" placeholder="Descrizione" class="p-2 h5" cols="30" rows="10">{{$apartment -> description}}</textarea>
            
            <div class="d-flex justify-content-between">
                <span class="d-flex flex-column ">
                    <label for="rooms">Stanze</label>
                    <input type="number" name="rooms" placeholder="Stanze" min="0" class="p-2 h5" value="{{$apartment -> rooms}}">
                </span>
        
                <span class="d-flex flex-column ">
                    <label for="beds">Letti</label>
                    <input type="number" name="beds" placeholder="Letti" min="0" class="p-2 h5" value="{{$apartment -> beds}}">
                </span>
                <span class="d-flex flex-column ">
                    <label for="bathrooms">Bagni</label>
                    <input type="number" name="bathrooms" placeholder="Bagni" min="0" class="p-2 h5" value="{{$apartment -> bathrooms}}">
                </span>

                <span class="d-flex flex-column ">
                    <label for="sq">Dimensione appartamento</label>
                    <input type="number" name="sq" placeholder="Metri Quadri" min="0" class="p-2 h5" value="{{$apartment -> sq}}">
                </span>
            </div>

            
            <label for="address">Indirizzo appartamento</label>
            <address-geocode actual-address="{{ $apartment -> address }}"></address-geocode>
            
            <label for="images">Immagine appartamento</label>
            <input type="file" name="images" class="text-white">
        </div>

        <div class="service-container container-xl d-flex flex-column p-5 rounded">
            <h3 class="">Servizi</h3>
    
            <ul class="row">
            @foreach ($services as $service)
            
                    <li class="list-group-item col-3">  
                        <input type="checkbox" name="services[]" value="{{ $service -> id }}"

                        @foreach ($apartment -> services as $apartmentService)
                            @if ($service -> id == $apartmentService -> id)
                                checked
                            @endif
                        @endforeach
                        
                        > {{ $service -> name }}
                    </li>

            @endforeach <br>

            </ul>

        </div>
        <div class="buttons text-center">
            <a href="{{ route('user.dashboard') }}" class="btn btn-darkBlue">Indietro</a>
            <input type="submit" value="Aggiorna" class="btn btn-orange">
        </div>
    </form>

@endsection