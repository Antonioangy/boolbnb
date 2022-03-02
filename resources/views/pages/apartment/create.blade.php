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

        
        <div class="insert-container container-xl bg-darkBlue d-flex flex-column p-5 rounded">
            <h1 class="text-white">Inserisci nuovo appartamento</h1>

            <input type="text" name="title" placeholder="Titolo" class="p-2 h5"> <br>
            
            <input type="text" name="description" placeholder="Descrizione" class="p-2 h5"><br>
            
            <input type="number" name="rooms" placeholder="Stanze" min="0" class="p-2 h5"><br>
    
            <input type="number" name="beds" placeholder="Letti" min="0" class="p-2 h5"><br>
            
            <input type="number" name="bathrooms" placeholder="Bagni" min="0" class="p-2 h5"><br>
            
            <input type="number" name="sq" placeholder="Metri Quadri" min="0" class="p-2 h5"><br>
    
            <input type="file" name="images" class="text-white"><br>
    
            <input type="text" name="address" placeholder="Address" class="p-2 h5"><br>
        </div>

        <div class="service-container container-xl d-flex flex-column p-5 rounded">
            <h3 class="">Servizi</h3>
    
            <ul class="row">

            @foreach ($services as $service)
            
                    <li class="list-group-item col-3">  <input type="checkbox" name="services[]" value="{{ $service -> id }}"> {{ $service -> name }}</li>
               

            @endforeach <br>

            </ul>

        </div>

        <div class="form-check">
            
            
        </div>



        <input type="submit" value="create">

    </form>

    <a href="{{ route('home') }}">BACK</a>
@endsection