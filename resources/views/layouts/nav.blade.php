<nav class="navbar navbar-expand-lg navbar-dark sticky-top py-1" style="background: #232C3D;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('front.home') }}">
            <img src="{{ asset('img/icon/logo.svg') }}" width="42" height="28" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" justify-content-between collapse navbar-collapse fw-bold text-lg" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ check_active(route('front.home')) }}" aria-current="page" href="{{ route('front.home') }}">@lang('home')</a>
                </li>
                {{-- <li class="nav-item">
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
                </li> --}}
    
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ check_active(route('front.carts.index')) }}" href="{{ route('front.carts.index') }}" 
                            tabindex="-1" aria-disabled="true"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                                <sup class="badge bg-warning px-1 text-theme">{{ numberTranslate(auth()->user()->carts->count()) }}</sup> 
                        </a>
                    </li> 
                @endauth
                @hasrole
                    <li class="nav-item">
                        <a class="nav-link {{ check_active(route('admin.dashboard')) }}" href="{{ route('admin.dashboard') }}" tabindex="-1" aria-disabled="true" title="@lang('dashboard')">
                            <i class="fa fa-user-cog" aria-hidden="true"></i>
                        </a>
                    </li>
                @endhasrole
                <li class="nav-item dropdown">
                    <a class="nav-link active" href="#" id="lang" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (session('locale') == "en")
                        @lang(session('locale'))
                    @elseif (session('locale') == "mm")
                        @lang(session('locale'))
                    @endif
                    </a>
                    <ul class="dropdown-menu text-theme" aria-labelledby="lang">
                        <li><a class="dropdown-item py-0" href="{{ route('locale.switch', 'mm') }}">@lang('mm') <img src="{{ asset('img/lang/myanmar.png') }}" class="mx-2" style="width: 20%" alt="mm"></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-0" href="{{ route('locale.switch', 'en') }}">@lang('en') <img src="{{ asset('img/lang/united-states.png') }}" class="mx-2" style="width: 20%" alt="en"></a></li>
                    </ul>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active" id="profile" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->user_name }}</a>
                        <ul class="dropdown-menu text-theme " aria-labelledby="profile">
                            <li>
                                <a href="#" class="dropdown-item py-1 px-2">@lang('profile') 
                                    <div class="float-end">
                                        {{-- <i class="fa fa-user-circle" aria-hidden="true"></i>  --}}
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.carts.index') }}" class="dropdown-item py-1 px-2">@lang('carts') 
                                    <div class="float-end">
                                        {{-- <i class="fa fa-shopping-cart" aria-hidden="true"></i>  --}}
                                        <span class="badge bg-theme">{{ numberTranslate(auth()->user()->carts->count()) }}</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('front.orders.index') }}" class="dropdown-item py-1 px-2">@lang('orders') 
                                    <div class="float-end">
                                        {{-- <i class="fa fa-shopping-basket" aria-hidden="true"></i>  --}}
                                        <span class="badge bg-theme">{{ numberTranslate(auth()->user()->orders->count()) }}</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post" class="">
                            @csrf
                            <button type="submit" class="border-0 nav-link fw-bold {{ check_active(route('logout')) }}" style="background: #232C3D">@lang('logout')</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ check_active(route('login')) }}">@lang('login')</a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ check_active(route('register')) }}">@lang('register')</a>
                    </li>
                @endauth
            </ul>        
        </div>
    </div>
</nav>
