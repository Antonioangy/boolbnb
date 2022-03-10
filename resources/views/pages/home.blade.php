@extends('layouts.main-layout')

@section('title')
    Bool-BnB
@endsection

@section('content')

{{-- jumbotron --}}
<section id="jumbotron" class="container-fluid d-flex">
    <div class="search_container m-auto">
        <form action="{{ route('apartments.results') }}" method="POST">
            @csrf
            <input type="text" name="addressQuery" placeholder="Dove vuoi andare?">
            <input type="submit" value="Cerca">
        </form>
    </div>
</section>

<div class="container cards_apartments">
    {{-- appartamenti sponsorizzati --}}
    <section class="row justify-content-center my-5">
        @foreach ($sponsoredApartments as $sponsoredApartment )
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="shadow p-3 my-3 bg-white rounded card_apartment">
                    <div class="photo_detail">
                        <h5 class="title_sponsored">
                            {{ $sponsoredApartment -> title }}
                        </h5>
                        @if ($sponsoredApartment->images)  
                            <img src="{{ asset('storage/assets/'.$sponsoredApartment -> images) }}" class="card-img-top" alt="apartment">
                        @endif
                    </div>
                    <div class="button">
                        <a href="{{ route('apartment.show', $sponsoredApartment ->id) }}" class="btn btn-blue">Vedi Appartamento</a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</div>

@endsection