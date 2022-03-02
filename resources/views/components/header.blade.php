<header>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="w-50" src="{{asset('storage/images/boolbnb-logo.png')}}" alt="bnb logo">
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
                            <button type="button" class="btn btn-orange" data-toggle="modal" data-target="#access">Accedi</button>
                        </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
    </div>

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
                    <form action="{{ route('login') }}" method="POST">
                        
                        @method('POST')
                        @csrf
                        
                        <label for="email">E-mail</label>
                        <input type="text" name="email"> <br>
                        <label for="password">Password</label>
                        <input type="password" name="password"> <br>
                        <br>
                        <input type="submit" value="LOGIN">
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
                        <input type="submit" value="REGISTER">
        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-darkBlue" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <a href="{{ route('home') }}">HOME</a> --}}
    {{--@auth
        <a href="{{ route('user.dashboard') }}">DASHBOARD</a>
    @else
        <a href="{{ route('access') }}">ACCEDI</a>
    @endauth --}}
</header>