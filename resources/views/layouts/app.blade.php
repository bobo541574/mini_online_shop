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
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">

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
        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s; 
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
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
    <script type="text/javascript" src="{{ asset('assets/jquery/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/select2/select2.min.js') }}"></script>

    <script>
        /* csrf torken */
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        /* localization */
        let locale = '{{ session('locale') }}';

        /* production mode */
        function isProduction() {
            let is_production = '{{ config('app.env') === 'production' }}';
            return (is_production == "") ? false : true;
        }

        const lang = {
            'mm' : [
                "၀",
                "၁",
                "၂",
                "၃",
                "၄",
                "၅",
                "၆",
                "၇",
                "၈",
                "၉",
                "၁၀",
            ],
            'en' : [
                "0",
                "1",
                "2",
                "3",
                "4",
                "5",
                "6",
                "7",
                "8",
                "9",
                "10",
            ],
        };

        function trans(data) {
            return lang[locale][data];
        }


    </script>

    @yield('script')
</body>
</html>