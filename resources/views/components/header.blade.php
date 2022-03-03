<header>
    <div>
        {{-- navbar header --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between flex-nowrap">
            {{-- logo --}}
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="w-50" src="{{asset('storage/images/boolbnb-logo.png')}}" alt="bnb logo">
            </a>

            <div class="text-center">
                {{-- nav hamburger menu  --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- lista link nav --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active m-2">
                            <a class="btn btn-blue text-white" href="{{ route('home') }}">Home</a>
                        </li>
                        @auth
                        <li class="nav-item align-self-center">
                            <a class="nav-link icon_container d-flex align-content-center justify-content-center text-darkBlue border border-darkBlue rounded-circle" href="{{ route('user.dashboard') }}">
                                <i class="fa-solid fa-user "></i>
                            </a>
                        </li>
                        @else
                        <li class="nav-item ">
                            {{-- pulsante accesso modal --}}
                            <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#access">Accedi</button>
                        </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    {{-- modal bootstrap per accesso --}}
    <div class="modal fade" id="access" tabindex="-1" role="dialog" aria-labelledby="access" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="access">Accedi o Registrati</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Entra</h2>
                    <form action="{{ route('login') }}" method="POST" class="mb-5">
                        
                        @method('POST')
                        @csrf
                        
                        <label class="mr-4" for="email">E-mail</label>
                        <input type="text" name="email"> <br>
                        <label for="password">Password</label>
                        <input type="password" name="password"> <br>
                        <br>
                        <input class="btn btn-blue" type="submit" value="Accedi">
                    </form>

                    <h2>Registrati</h2>
                    <form action="{{ route('register') }}" method="POST">

                        @method('POST')
                        @csrf
        
                        <label for="name">Name</label>
                        <input type="text" name="name"> <br>
        
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name"> <br>
        
                        <label for="email">E-mail</label>
                        <input type="text" name="email"> <br>
        
                        <label for="birth_day">Birthday</label>
                        <input type="date" name="birth_day"> <br>
        
                        <label for="password">Password</label>
                        <input type="password" name="password"> <br>
        
                        <label for="password_confirmation">Password confirm</label>
                        <input type="password" name="password_confirmation"> <br>
        
                        <br>
                        <input class="btn btn-blue" type="submit" value="Registrati">
        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-darkBlue" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</header>