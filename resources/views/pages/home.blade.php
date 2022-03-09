@extends('layouts.main-layout')

@section('title')
    Bool-BnB
@endsection

@section('content')

{{-- jumbotron --}}
<section id="jumbotron" class="mb-5 d-flex">
    <div class="search_container m-auto">
        <form action="{{ route('apartments.results') }}" method="POST">
            @csrf
                <div class="input-group">
                    <input type="search" class="form-control rounded" placeholder="dove vuoi andare?" aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn bg-light"><i class="fa fa-search"></i></button>
                </div>
        </form>
    </div>

</section>

<div class="container">

    {{-- appartamenti sponsorizzati --}}
    <section class="row">

        @foreach ($sponsoredApartments as $sponsoredApartment )
            
        <div class="col-12 col-md-4 card d-flex flex-column justify-content-between " style="width: 18rem;">
            <div class="card-body">
                @if ($sponsoredApartment->images)  
                    <img src="{{ asset('storage/assets/'.$sponsoredApartment -> images) }}" class="card-img-top" alt="non trovo immagine">
                @endif
                <h5 class="card-title">
                    {{ $sponsoredApartment -> title }}
                </h5>
                <p class="card-text text_clamp">
                    {{ $sponsoredApartment -> description }}
                </p>
            </div>
            <div class="text-center">
                <a href="{{ route('apartment.show', $sponsoredApartment ->id) }}" class="btn btn-blue">
                    Vedi Appartamento
                </a>
            </div>
        </div>
        @endforeach
    </section>
</div>

@endsection