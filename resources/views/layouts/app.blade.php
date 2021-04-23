<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('layouts.meta-tag')

    <title>{{ config('app.name') }}</title>

    @include('layouts.style')

</head>
<body>
    
    @include('layouts.nav')

    @include('front.shared._flashmessage')
    <div class="container-fluid">
        <main class="py-1">
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

    @include('layouts.script')
    
</body>
</html>