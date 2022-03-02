<header>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('storage/images/boolbnb-logo.png')}}" alt="bnb logo">
            </a>

            <div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link orange" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.dashboard') }}"><i class="fa-solid fa-user orange"></i></a>
                        </li>
                        @else
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('access') }}">Accedi o Registrati</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
            
        </nav>
    </div>
        {{-- <a href="{{ route('home') }}">HOME</a> --}}
{{--     @auth
        <a href="{{ route('user.dashboard') }}">DASHBOARD</a>
    @else
        <a href="{{ route('access') }}">ACCEDI</a>
    @endauth --}}
</header>