<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: #232C3D;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bolder" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-md-flex justify-content-between collapse navbar-collapse fw-bold text-lg" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ check_active(route('front.home')) }}" aria-current="page" href="{{ route('front.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ check_active(route('front.home')) }}" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ check_active(route('front.home')) }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ check_active(route('front.home')) }}" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
    
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a href="#" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post" class="">
                            @csrf
                            <button type="submit" class="border-0 nav-link fw-bold {{ check_active(route('logout')) }}" style="background: #232C3D">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ check_active(route('login')) }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link {{ check_active(route('register')) }}">Register</a>
                    </li>
                @endauth
            </ul>        
        </div>
    </div>
</nav>
