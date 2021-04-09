<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Mini Online Shop</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body">
    
    @include('layouts.nav')

    <div class="container">

        <main class="py-4">
            @yield('content')
        </main>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('script')
</body>
</html>