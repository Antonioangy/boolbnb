@extends('layouts.main-layout')

@section('title')
    {{ $apartment -> title }}
@endsection

@section('content')

    <section id="apartment_show" class="container py-4">

        {{-- TITOLO APPARTAMENTO, LOCALITA RECENSIONE --}}
        <h2>
            {{ $apartment -> title }}
        </h2>
        <h5>
            <i class="fa-solid fa-location-dot"></i> {{ $apartment -> address }}
        </h5>

        {{-- SHOW APPARTAMENTO --}}
        <div class="row">
            <div class="col-12 col-md-7">
                @if ($apartment->images) 
                    <img class="img-fluid img-thumbnail rounded" src="{{asset('storage/assets/'. $apartment->images)}}" alt="{{$apartment -> title}}">
                @endif
                
                {{-- info generali --}}
                <div class="border-bottom py-3">
                    <h3>
                        Informazioni generali
                    </h3>
                    <div class="d-flex align-items-center">
                        <span class="d-flex align-items-center mr-3">
                            <i class="fa-solid fa-house mr-1"></i>
                            <span>
                                Stanze: {{ $apartment -> rooms }}
                            </span>
                        </span>
                        <span class="d-flex align-items-center mr-3">
                            <i class="fa-solid fa-bed mr-1"></i>
                            <span>
                                Letti: {{ $apartment -> beds }}
                            </span> 
                        </span>
                        <span class="d-flex align-items-center mr-3">
                            <i class="fa-solid fa-bath mr-1"></i> 
                            <span>
                                Bagni: {{ $apartment -> bathrooms }}
                            </span>
                        </span>
                        <span class="d-flex align-items-center">
                            <i class="fa-solid fa-square mr-1"></i>
                            <span>
                                {{ $apartment -> sq }} m<sup>2</sup>
                            </span>
                        </span>
                    </div>
                </div>

                {{-- descrizione appartamento --}}
                <div class="border-bottom py-3">
                    <h3>
                        Descrizione
                    </h3>
                    <p class="text-justify m-0">
                        {{ $apartment -> description }}
                    </p>
                </div>

                {{-- SERVIZI DISPONIBILI APPARTAMENTO --}}
                <div class="border-bottom py-3">
                    <h3>
                        Servizi
                    </h3>
                    <ul class="row">
                        @foreach ($apartment -> services as $apartmentService)       
                            <li class="d-flex align-items-center col-12 col-md-6 col-lg-4 mt-2">  

                                @if ($apartmentService -> name == 'WiFi')
                                    <i class="fa-solid fa-wifi mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Sauna')
                                    <i class="fa-solid fa-temperature-full mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Aria Condizionata')
                                    <i class="fa-solid fa-fan mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Caffè')
                                    <i class="fa-solid fa-mug-saucer mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'TV')
                                    <i class="fa-solid fa-tv mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Posto Auto')
                                    <i class="fa-solid fa-car mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Piscina')
                                    <i class="fa-solid fa-person-swimming mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Vista Mare')
                                    <i class="fa-solid fa-water mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Portineria')
                                    <i class="fa-solid fa-bell-concierge mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Doccia')
                                    <i class="fa-solid fa-shower mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'È permesso fumare')
                                    <i class="fa-solid fa-smoking mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Piatti e posate')
                                    <i class="fa-solid fa-utensils mr-3"></i> {{ $apartmentService -> name}}
                                @elseif($apartmentService -> name == 'Vasca da bagno')
                                    <i class="fa-solid fa-bath mr-3"></i> {{ $apartmentService -> name}}
                                
                                @else
                                    <i class="fa-solid fa-wifi mr-3"></i> {{ $apartmentService -> name}}
                                @endif
                                   
                               
                            </li>
                        @endforeach <br>
                    </ul>
                </div>
            </div>

            {{-- FORM RICHIESTA INFO PER APPARTAMENTO --}}
            <div class="col-12 col-md-5">
                <div class="card shadow mb-3 mb-md-0 sticky-top">
                    <div class="card-body">

                        <h3>Contatta l'host</h3>

                        <form action="{{ route('apartment.message_send', $apartment -> id) }}" method="POST">
                            @method('POST')
                            @csrf
                
                            <div class="form-group">
                                
                                {{-- email mittente --}}
                                <label for="sender">Tua email</label>
                                <input 
                                    type="email" 
                                    name="sender"
                                    class="form-control" 
                                    {{-- se utente registrato usa la sua mail --}}
                                    @auth
                                        readonly 
                                        value="{{$user -> email}}"
                                    @endauth
                                > 
                            </div>

                            {{-- testo messaggio --}}
                            <div class="form-group">
                                <label for="text">Messaggio</label>
                                <textarea 
                                    name="text" 
                                    rows="3" 
                                    class="form-control" 
                                    placeholder="Inserisci il tuo messaggio"
                                ></textarea>
                            </div>
                            <input type="submit" value="Invia Messaggio" class="btn btn-orange">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- MAPPA APPARTAMENTO --}}
        <div class="col-12 p-0 py-3">
            <h3>
                Posizione
            </h3>
            <h6>
                {{ $apartment -> address }}
            </h6>

            @if ($apartment -> longitude != '')
                <apartment-map :lng="{{ $apartment -> longitude }}" :lat="{{ $apartment -> latitude }}"></apartment-map>
            @endif
        </div>
    </section>    
@endsection