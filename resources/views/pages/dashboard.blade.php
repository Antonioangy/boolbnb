@extends('layouts.main-layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <main id="dashboard" class="container py-5">
        @auth
            <div class="d-flex justify-content-between my-2">
                <h3>Ciao <span class="text-orange">{{ Auth::user() -> name }}</span>!</h3>

                {{-- Bottone creazione nuovo appartamento --}}
                <div>
                    <a class="btn btn-orange" href="{{ route('apartment.create') }}">Crea un nuovo appartamento <i class="fa-solid fa-circle-plus ml-2"></i></a>
                </div>
            </div>

            {{-- appartamenti dell'host --}}
            <h5 class="text-center">
                <b>I tuoi appartamenti</b>
            </h5>
            <apartment-user-list></apartment-user-list>

            {{-- STATISTICHE APPARTAMENTI --}}
            <h5 class="text-center my-5">
                <b>Statistiche appartamenti</b>
            </h5>
            <apartment-chart></apartment-chart>

            {{-- messaggi ricevuti da utenti  --}}
            @if (count($obj))
                <h5 class="my-5 text-center"><b>Messaggi ricevuti</b></h5>
            @endif
            <div class="messaggiRicevuti">
                @foreach ($obj as $item)
                    <div class="text-center shadow p-3 my-3 bg-white rounded">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                                <i class="fas fa-home"></i>
                                <span>Alloggio: {{$item -> apartment -> title}}</span>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <i class="fas fa-user"></i>
                                Mittente: {{$item -> message -> sender}}
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-left">
                                <span><b>Messaggio: </b>{{$item -> message -> text}}</span><br>
                                <span><b>Ricevuto il: </b>{{$item -> message -> created_at -> format ('d/m/Y - H:i')}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endauth
    </main>
@endsection