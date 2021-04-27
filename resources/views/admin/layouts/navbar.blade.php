<nav class="navbar navbar-expand navbar-light navbar-bg fw-bold">
    <a class="sidebar-toggle d-flex">
        <i class="hamburger align-self-center"></i>
    </a>

    <form class="d-none d-sm-inline-block">
        <div class="input-group input-group-navbar">
            <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
            <button class="btn" type="button">
                <i class="align-middle" data-feather="search"></i>
            </button>
        </div>
    </form>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    @if (session('locale') == "en")
                        {{-- <img src="{{ asset('img/lang/united-states.png') }}" class="img-fluid mx-2" style="width: 4%" alt="mm"> --}}
                        <span>@lang(session('locale'))</span>
                    @elseif (session('locale') == "mm")
                        {{-- <img src="{{ asset('img/lang/myanmar.png') }}" class="img-fluid mx-2" style="width: 4%" alt="mm"> --}}
                        <span>@lang(session('locale'))</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start text-theme" aria-labelledby="lang">
                    <li><a class="dropdown-item py-0" href="{{ route('locale.switch', 'mm') }}">@lang('mm') <img src="{{ asset('img/lang/myanmar.png') }}" class="mx-2 lang-img" alt="mm"></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-0" href="{{ route('locale.switch', 'en') }}">@lang('en') <img src="{{ asset('img/lang/united-states.png') }}" class="mx-2 lang-img" alt="en"></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('img/male.jpg') }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span
                        class="text-dark">{{ auth()->user()->user_name ?? '' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                            data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i>
                        Analytics</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1"
                            data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help
                        Center</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
