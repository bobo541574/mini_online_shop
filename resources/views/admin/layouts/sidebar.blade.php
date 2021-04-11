<nav id="sidebar" class="sidebar mb-5">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">MOS</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                @lang('admin')
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="index.html">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">@lang('dashboard')</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-settings.html">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                </a>
            </li>

            <li class="sidebar-header">
                @lang('user_manage')
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">@lang('users')</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('users.index') }}">@lang('users')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('permissions.index') }}">@lang('permissions')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('roles.index') }}">@lang('roles')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('assigns.index') }}">@lang('assigns')</a></li>
                    </li>
                </ul>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-invoice.html">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Invoice</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-blank.html">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Auth</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Sign In</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign Up</a></li>
                </ul>
            </li> --}}

            <li class="sidebar-header">
                @lang('product_manage')
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#products" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">@lang('products')</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">@lang('categories')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('subcategories.index') }}">@lang('subcategories')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-cards.html">@lang('brands')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-general.html">@lang('products')</a></li>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
