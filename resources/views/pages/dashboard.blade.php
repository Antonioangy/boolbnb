@extends('layouts.main-layout')

@section('title')
    Dashboard
@endsection

@section('content')
    <main class="container-xl">
    
        @auth
            
            
            <div class="row">
                <div class="col-6">
                <h3>Ciao {{ Auth::user() -> name }}!</h3>
                </div>
                <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-secondary" href="{{ route('logout') }}">LOGOUT</a>
                </div>
            </div>
           
            
            {{-- appartamenti dell'host --}}
            <h5>
                I tuoi appartamenti:
            </h5>
            <apartment-user-list></apartment-user-list>
            {{-- Bottone creazione nuovo appartamento --}}
            <button class="btn btn-darkBlue"><a href="{{ route('apartment.create') }}">CREA UN NUOVO APPARTAMENTO</a></button>
            {{-- messaggi ricevuti da utenti  --}}
            <h5 class="mt-4">Messaggi ricevuti:</h5>
            <div class="d-flex flex-column-reverse">
                @foreach ($obj as $item)
                    <div>
                        <div onclick="myFunction(this)"><h5><i class="fas fa-home"></i> Alloggio: {{$item -> apartment -> title}} <i class="fas fa-user"></i> Mittente: {{$item -> message -> sender}}</h5>
                            <div id="commentoUtente" style="display:none"></div>
                                <p class="m">Commento: {{$item -> message -> text}}</p>
                                <p>inviato il {{$item -> message -> created_at -> format ('d/m/Y A h:i')}}</p>
                            </div> 
                        </div>
                        <hr>
                    </div>
                @endforeach
                
            </div>
            
        @endauth
            {{-- funzione per apparizione commento --}}
        <script>
            function myFunction(element) {
                
                x = element.lastChild;
        
              if (x.style.display === "none") {
                x.style.display = "block";
              } else {
                x.style.display = "none";
              }
            }
        </script>
    </main>
@endsection