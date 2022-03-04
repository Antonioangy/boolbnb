@extends('layouts.main-layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <main class="container-xl">
    
        @auth
        
            <h3 class="text-center">Ciao {{ Auth::user() -> name }}!</h3>

            {{-- appartamenti dell'host --}}
            <h5 class="text-center">
                <b>I tuoi appartamenti</b>
            </h5>
            <apartment-user-list></apartment-user-list>

            {{-- Bottone creazione nuovo appartamento --}}
            <div class="text-center mt-4">
                <a class="btn btn-darkBlue" href="{{ route('apartment.create') }}">CREA UN NUOVO APPARTAMENTO</a>
            </div>

            {{-- messaggi ricevuti da utenti  --}}
            {{-- @if (count($obj)) --}}
                <h5 class="mt-4 text-center"><b>Messaggi ricevuti</b></h5>
            {{-- @endif --}}
            
            <div>
                @foreach ($obj as $item)
                    <div onclick="myFunction(this)" class="text-center">
                        <div class="alloggio">
                            <i class="fas fa-home"></i> 
                            Alloggio: {{$item -> apartment -> title}} 
                        </div>
                        <div class="sender">
                            <i class="fas fa-user"></i>
                            Mittente: {{$item -> message -> sender}}
                        </div>
                        <div id="commentoUtente" style="display:none">
                            <p class="m"><b>Commento:</b> {{$item -> message -> text}}</p>
                            <p>inviato il {{$item -> message -> created_at -> format ('d/m/Y A h:i')}}</p>
                        </div> 
                    </div>
                    <hr>
                @endforeach
            </div>
            
        @endauth
            {{-- funzione per apparizione commento --}}
        {{-- <script>
            function myFunction(element) {
                
                x = element.lastChild;
        
              if (x.style.display === "none") {
                x.style.display = "block";
              } else {
                x.style.display = "none";
              }
            }
        </script> --}}
    </main>
@endsection