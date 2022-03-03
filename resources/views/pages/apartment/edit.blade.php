@extends('layouts.main-layout')
@section('content')
    <form 
    enctype="multipart/form-data" 
    action="{{ route('apartment.update', $apartment -> id )}}" 
    method="POST">

        @method('POST')
        @csrf

        <div class="insert-container container-xl bg-darkBlue d-flex flex-column p-5 rounded text-white">
            <h1 class="text-white">Aggiorna appartamento</h1>

            <label for="title">Titolo</label>
            <input type="text" name="title" placeholder="Titolo" class="p-2 h5" value="{{$apartment -> title}}"> <br>
            
            <label for="description">Descrizione</label>
            <input type="text" name="description" placeholder="Descrizione" class="p-2 h5" value="{{$apartment -> description}}"><br>
            
            <label for="rooms">Stanze</label>
            <input type="number" name="rooms" placeholder="Stanze" min="0" class="p-2 h5" value="{{$apartment -> rooms}}"><br>
    
            <label for="beds">Letti</label>
            <input type="number" name="beds" placeholder="Letti" min="0" class="p-2 h5" value="{{$apartment -> beds}}"><br>
            
            <label for="bathrooms">Bagni</label>
            <input type="number" name="bathrooms" placeholder="Bagni" min="0" class="p-2 h5" value="{{$apartment -> bathrooms}}"><br>
            
            <label for="sq">Dimensione appartamento</label>
            <input type="number" name="sq" placeholder="Metri Quadri" min="0" class="p-2 h5" value="{{$apartment -> sq}}"><br>
    
            <label for="images">Immagine appartamento</label>
            <input type="file" name="images" class="text-white"><br>
    
            <label for="address">Indirizzo appartamento</label>
            <input type="text" name="address" placeholder="Address" class="p-2 h5" value="{{$apartment -> address}}"><br>
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