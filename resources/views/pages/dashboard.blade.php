@extends('layouts.main-layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <main id="dashboard" class="container-xl my-5">
    
        @auth
        
            <h3 class="text-center">Ciao {{ Auth::user() -> name }}!</h3>

            {{-- appartamenti dell'host --}}
            <h5 class="text-center">
                <b>I tuoi appartamenti</b>
            </h5>
            <apartment-user-list :views="{{ $views }}"></apartment-user-list>

            {{-- Bottone creazione nuovo appartamento --}}
            <div class="text-center my-5">
                <a class="btn btn-darkBlue" href="{{ route('apartment.create') }}">Crea un nuovo appartamento <i class="fa-solid fa-circle-plus ml-2"></i></a>
            </div>

            {{-- messaggi ricevuti da utenti  --}}
            @if (count($obj))
                <h5 class="mt-4 text-center"><b>Messaggi ricevuti</b></h5>
            @endif
            
            <div class="messaggiRicevuti">
                @foreach ($obj as $item)
                    <div class="text-center">
                        <div class="alloggio">
                            <i class="fas fa-home"></i> 
                            Alloggio: {{$item -> apartment -> title}} 
                        </div>
                        <div class="sender">
                            <i class="fas fa-user"></i>
                            Mittente: {{$item -> message -> sender}}
                        </div>
                        <div id="commentoUtente">
                            <p><b>Commento:</b> {{$item -> message -> text}}</p>
                            <p>inviato il {{$item -> message -> created_at -> format ('d/m/Y - H:i')}}</p>
                        </div> 
                        <hr>
                    </div>
                @endforeach
            </div>
            
        @endauth
    </main>
@endsection