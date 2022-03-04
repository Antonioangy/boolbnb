@extends('layouts.main-layout')

@section('title')
    Bool-BnB
@endsection

@section('content')

{{-- jumbotron --}}
<section id="jumbotron" class="mb-5 d-flex">
    
    <div class="search_container m-auto">
        <apartments-search></apartments-search>
    </div>

</section>

<div class="container">

    {{-- appartamenti sponsorizzati --}}
    <section class="row">

        @foreach ($sponsoredApartments as $sponsoredApartment )
            
        <div class="col-12 col-md-4 card " style="width: 18rem;">
            @if ($sponsoredApartment->images)  
                <img src="{{ asset('storage/assets/'.$sponsoredApartment -> images) }}" class="card-img-top" alt="non trovo immagine">
            @endif
            <div class="card-body">
                <h5 class="card-title">
                    {{ $sponsoredApartment -> title }}
                </h5>
                <p class="card-text text_clamp">
                    {{ $sponsoredApartment -> description }}
                </p>
                <a href="{{ route('apartment.show', $sponsoredApartment ->id) }}" class="btn btn-blue">
                    Vedi Appartamento
                </a>
            </div>
        </div>
        @endforeach
    </section>
</div>


{{-- <table>
    <tr>
        <th>
            Titolo
        </th>
        <th>
            Descrizione
        </th>
        <th>
            Stanze
        </th>
        <th>
            Letti
        </th>
        <th>
            Bagni
        </th>
        <th>
            Square
        </th>
        <th>
            Indirizzo
        </th>
        <th>
            img
        </th>
    </tr>

        @foreach ($apartments as $apartment)
        <tr>
            <td>
                <a href="{{route('apartment.show', $apartment -> id)}}">{{ $apartment -> title }}</a>
            </td>       
            <td>
                {{ $apartment -> description }}
            </td>  
            <td>
                {{ $apartment -> rooms }}
            </td>  
            <td>
                {{ $apartment -> beds }}
            </td>   
            <td>
                {{ $apartment -> bathrooms }}
            </td> 
            <td>
                {{ $apartment -> sq }}
            </td>  
            <td>
                {{ $apartment -> address }}
            </td>  
            <td>
                {{ $apartment -> images }}
            </td> 
        </tr> 
        @endforeach

</table> --}}
    
@endsection