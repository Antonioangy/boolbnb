@extends('layouts.main-layout')

@section('title')
    Bool-BnB
@endsection

@section('content')

{{-- jumbotron --}}
<section id="jumbotron" class="container-fluid d-flex align-items-center justify-content-center position-relative">
    <blockquote class="blockquote quote text-right position-absolute mr-5">
        <p class="mb-0 text-left h2">Viaggiare rende modesti.<br>Ci mostra quanto &egrave; piccolo il posto che occupiamo.</p>
        <footer class="blockquote-footer">Gustave Flaubert <cite title="Source Title">frasimania.it</cite></footer>
    </blockquote>
    {{-- <div class="search_container "> --}}
        <form class="search_apartment d-flex justify-content-center flex-grow-1" action="{{ route('apartments.results') }}" method="POST">
            @csrf
            <input class="text rounded-pill border-0" type="text" name="addressQuery" placeholder="Dove vuoi andare?">
            <button class="submit btn  rounded-circle bg-orange " type="submit"><i class="fa-solid fa-magnifying-glass px-2"></i></button>
        </form>
    {{-- </div> --}}
</section>

<div class="container cards_apartments">
    {{-- appartamenti sponsorizzati --}}
    <h1 class="text-center mt-4 text-darkBlue"><b>Appartamenti in evidenza</b></h1>
    <section class="row justify-content-center my-5">

        @foreach ($sponsoredApartments as $sponsoredApartment )
        
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="shadow p-3 my-3 bg-white rounded card_apartment">
                    <div class="photo_detail">
                        <h5 class="title_sponsored">
                            {{ $sponsoredApartment -> title }}
                        </h5>
                        <span class="subtitle"><i class="fa-solid fa-location-dot text-orange"></i> {{ $sponsoredApartment -> address }}</span>
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

    <section class="text-center my-5 pt-5">
        <h1 class="my-3 text-orange"><b>Scopri BoolBnb</b> </h1>
        <span class="mb-3">Ti diamo il benvenuto nel sito viaggi di Boolbnb. <br>Ovunque tu vada, Boolbnb ha l'alloggio per te. </span>
        <h3 >Cosa rende speciale Boolbnb</h3>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 shadow p-3 my-3 bg-white rounded">
                <i class="fa-solid fa-earth-europe display-4 text-orange my-5"></i><br>
                <h5>Una community di viaggi globale</h5>
                <p><b>Boolbnb è disponibile in oltre 191 Paesi, dove i nostri Standard
                    della community contribuiscono a promuovere la sicurezza e
                    l'appartenenza di tutti.</b>
                </p>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 shadow p-3 my-3 bg-white rounded">
                <i class="fa-solid fa-heart display-4 text-orange my-5"></i><br>
                <h5>Host premurosi</h5>
                <p><b>Che si tratti di alloggi o di hotel, qualunque sia la tua destinazione gli host fanno di tutto per metterti a tuo agio.</b> </p>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 shadow p-3 my-3 bg-white rounded">
                <i class="fa-solid fa-info display-4 text-orange my-5"></i><br>
                <h5>Siamo qui per te, giorno e notte </h5>
                <p><b>Il nostro servizio di assistenza internazionale, attivo 24 ore su 24, è disponibile in 11 lingue ed è pronto ad aiutarti ovunque ti trovi.</b> </p>
            </div>
        </div>
    </section>
</div>

@endsection