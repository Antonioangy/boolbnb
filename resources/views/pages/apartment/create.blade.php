@extends('layouts.main-layout')

@section('title')
    Nuovo appartamento
@endsection


@section('content')
    <form 
    class="py-5"
    enctype="multipart/form-data" 
    action="{{ route('apartment.store') }}" 
    method="POST">

        @method('POST')
        @csrf

        
        <div class="insert-container container-xl bg-darkBlue d-flex flex-column justify-content-between p-5 rounded">
            <h1 class="text-white">Inserisci nuovo appartamento</h1>
            
            <input type="text" name="title" placeholder="Titolo" class="p-2 h5"> 
            
            <textarea name="description" placeholder="Descrizione" class="p-2 h5" cols="30" rows="10"></textarea>

            <div class="d-flex justify-content-between">

                <input type="number" name="rooms" placeholder="Stanze" min="0" class="p-2 h5">
        
                <input type="number" name="beds" placeholder="Letti" min="0" class="p-2 h5">
                
                <input type="number" name="bathrooms" placeholder="Bagni" min="0" class="p-2 h5">
                
                <input type="number" name="sq" placeholder="Metri Quadri" min="0" class="p-2 h5">
            </div>
    
            
            <address-geocode ></address-geocode>
            
            <input type="file" name="images" class=" text-white">
        </div>

        <div class="service-container container-xl d-flex flex-column p-5 rounded">
            <h3 class="">Servizi</h3>
    
            <ul class="row">

                @foreach ($services as $service)
                
                    <li class="list-group-item col-xl-3 col-lg-4 col-sm-6">  <input type="checkbox" name="services[]" value="{{ $service -> id }}"> {{ $service -> name }}</li>
                

                @endforeach <br>

            </ul>

        </div>
        <div class="buttons text-center">
            <a href="{{ route('user.dashboard') }}" class="btn btn-darkBlue">Indietro</a>
            <input type="submit" value="Crea" class="btn btn-orange">
        </div>
    </form>

@endsection