<header>
    <h1>
        Hello World
    </h1>

    <a href="{{ route('home') }}">HOME</a>
    @auth
    <a href="{{ route('user.dashboard') }}">DASHBOARD</a>
    
    @else


    <a href="{{ route('access') }}">ACCEDI</a>
    @endauth
</header>