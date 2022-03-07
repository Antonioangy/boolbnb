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

@endsection