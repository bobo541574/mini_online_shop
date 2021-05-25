<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/icon/logo.svg') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
<link href="{{ asset('assets/fontawesome/webfonts/fa-solid-900.woff2') }}">
<link href="{{ asset('assets/fontawesome/webfonts/fa-solid-900.ttf') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">

<style>
    .nav-custom-color {
        background: #FDFC47;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #24FE41, #FDFC47);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #24FE41, #FDFC47); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .bg-header {
        background: #FDFC47;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #24FE41, #FDFC47);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #24FE41, #FDFC47); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .text-theme {
        color: #232C3D !important;
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

    .lang-img {
        width: 25px;
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
