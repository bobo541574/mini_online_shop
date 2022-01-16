<nav id="sidebar" class="sidebar mb-5">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('front.home') }}">
            <span class="align-middle">MOS</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                @lang('admin')
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('users.show', auth()->user()) }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">@lang('profile')</span>
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
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('email.create') }}">@lang('email')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('users.index') }}">@lang('users')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('permissions.index') }}">@lang('permissions')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('roles.index') }}">@lang('roles')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('assigns.permissions-index') }}">@lang('assigns')</a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                @lang('category_manage')
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#category-menu" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="align-justify"></i> <span class="align-middle">@lang('category')</span>
                </a>
                <ul id="category-menu" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">@lang('categories')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('subcategories.index') }}">@lang('subcategories')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('brands.index') }}">@lang('brands')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('assigns.categories-index') }}">@lang('brands_categories')</a></li>
                </ul>
            </li>
            <li class="sidebar-header">
                @lang('attribute_manage')
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#attributes" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="hash"></i> <span class="align-middle">@lang('attributes')</span>
                </a>
                <ul id="attributes" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('colors.index') }}">@lang('colors')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('sizes.index') }}">@lang('sizes')</a></li>
                </ul>
            </li>
            <li class="sidebar-header">
                @lang('product_manage')
            </li>
            <li class="sidebar-item">
                <a href="{{ route('products.index') }}" class="sidebar-link">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">@lang('products')</span>
                </a>
            </li>
            <li class="sidebar-header">
                @lang('payment_manage')
            </li>
            <li class="sidebar-item">
                <a href="{{ route('payments.index') }}" class="sidebar-link">
                    <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">@lang('payments')</span>
                </a>
            </li>
        </ul>
        
        {{-- <div class="sidebar-cta">
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
        </div> --}}
    </div>
</nav>
