<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.meta-tag')

    <title>{{ config('app.name') }}</title>
        
    @include('admin.layouts.style')
</head>

<body>
    <div class="wrapper">

        @include('admin.layouts.sidebar')

        <div class="main">

            @include('admin.layouts.navbar')

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('content')
                    
                </div>
            </main>

            @include('admin.layouts.footer')
        </div>
    </div>

    @include('admin.layouts.script')
</body>

</html>
