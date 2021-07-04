<nav class="fw-bold" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('front.home') }}">@lang('home')</a></li>
        @foreach ($items as $key => $item)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">@lang($key)</li>
            @else
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ $item }}">@lang($key)</a></li>
            @endif
            
        @endforeach
    </ol>
</nav>
<hr class="border border-dark" />