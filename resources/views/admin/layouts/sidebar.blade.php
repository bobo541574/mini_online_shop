<nav id="sidebar" class="sidebar">
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
                User Maintenance
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">User</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('permissions.index') }}">Permissions</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('assigns.index') }}">Permission Assign</a></li>
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
                Products Maintenance
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#products" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Products</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('subcategories.index') }}">Sub-Categories</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-cards.html">Brands</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-general.html">Products</a></li>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
