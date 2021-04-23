<div class="row mb-2 mb-xl-3">
    <div class="col-auto d-none d-sm-block">
        <h3><strong>Analytics</strong> Dashboard</h3>
    </div>

    <div class="col-auto ms-auto text-end mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('dashboard')</a></li>
                @foreach ($items as $key => $item)
                    @if ($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">@lang($key)</li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ $item }}">
                                @lang($key)
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</div>