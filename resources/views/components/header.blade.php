<header class="container">
    <div>
        {{-- navbar header --}}
        <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between flex-nowrap">
            {{-- logo --}}
            <a class="logo_container" href="{{ route('home') }}">
                <img class="w-100" src="{{asset('storage/images/boolbnb-logo.png')}}" alt="bnb logo">
            </a>

            <div class="text-center">
                {{-- nav hamburger menu  --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- lista link nav --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item active m-2">
                            <a class="btn btn-blue text-white" href="{{ route('home') }}">Home</a>
                        </li>
                        @auth
                        <li class="nav-item align-self-center">
                            {{-- pulsante pannello utente modal --}}
                            <button type="button" class="icon_container align-content-center justify-content-center text-darkBlue border border-darkBlue rounded-circle" data-toggle="modal" data-target="#userTab">
                                <i class="fa-solid fa-user "></i>
                            </button>
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
                        <div>
                            <label for="email">E-mail</label>
                            <input type="text" name="email">
                        </div>
                        
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password">
                        </div>
                    
                        <input class="btn btn-blue btn_login" type="submit" value="Accedi">
                    </form>

                    <h2>Registrati</h2>
                    <form action="{{ route('register') }}" method="POST">

                        @method('POST')
                        @csrf
        
                        <label for="name">Name &ast;</label>
                        <input type="text" name="name">
        
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name">
        
                        <label for="email">E-mail &ast;</label>
                        <input type="text" name="email">
        
                        <label for="birth_day">Birthday</label>
                        <input type="date" name="birth_day">
        
                        <label for="password">Password &ast;</label>
                        <input type="password" name="password">
        
                        <label for="password_confirmation">Password confirm &ast;</label>
                        <input type="password" name="password_confirmation">
                        
                        <div class="font-italic h6 my-3">&ast; I campi contrassegnati sono obbligatori</div>
                        
                        <input class="btn btn-blue btn_register" type="submit" value="Registrati">
        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-darkBlue" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal user dashboard/logout --}}
      <div class="modal fade" id="userTab" tabindex="-1" role="dialog" aria-labelledby="userTabTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userTabTitle">Pannello Utente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body d-flex justify-content-around">
              <a href="{{ route('user.dashboard') }}" class="btn btn-darkBlue">Dashboard</a>
              <a class="btn btn-orange" href="{{ route('logout') }}">Logout</a>
            </div>
          </div>
        </div>
      </div>
</header>