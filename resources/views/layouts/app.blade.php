<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">

    <style>
        .text-theme {
            color: #232C3D;
        }
        .text-theme:hover {
            color: #676767;
        }
        .bg-theme {
            background-color: #232C3D;
        }
        .product-card:hover {
            transition: all 0.5s ease-out;
            box-shadow: 1px 1px 28px rgba(73, 73, 73, 0.3);
            top: -1px;
            background-color: whitesmoke;
        }
    </style>

</head>
<body">
    
    @include('layouts.nav')

    <div class="container-fluid">
        <main class="py-1">
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        /* csrf torken */
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        /* localization */
        let locale = '{{ session('locale') }}';

        function isProduction() {
            let is_production = '{{ config('app.env') === 'production' }}';
            return (is_production == "") ? false : true;
        }

        isProduction() ? window.location.protocol = "https" : "";

    </script>

    @yield('script')
</body>
</html>