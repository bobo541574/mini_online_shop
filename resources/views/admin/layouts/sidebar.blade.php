<nav id="sidebar" class="sidebar mb-5">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">MOS</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                @lang('admin')
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="index.html">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">@lang('dashboard')</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-profile.html">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="pages-settings.html">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                </a>
            </li> --}}

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
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('assigns.permissions-index') }}">@lang('assigns')</a></li>
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
                @lang('category_manage')
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#category-menu" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">@lang('category')</span>
                </a>
                <ul id="category-menu" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">@lang('categories')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('subcategories.index') }}">@lang('subcategories')</a></li>
                </ul>
            </li>
            <li class="sidebar-header">
                @lang('product_manage')
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#products" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">@lang('products')</span>
                </a>
                <ul id="products" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('brands.index') }}">@lang('brands')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('assigns.categories-index') }}">@lang('brands_categories')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('colors.index') }}">@lang('colors')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('sizes.index') }}">@lang('sizes')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('products.index') }}">@lang('products')</a></li>
                </ul>
            </li>
        </ul>
        
        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary">Upgrade to
                        Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>
