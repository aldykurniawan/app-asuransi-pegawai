<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="semi-dark" id="base--template">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'SIMASKOT') }}</title>
        <link  rel="shortcut icon" type="image/png" href="{{ asset('fe/assets/img/logo3.svg') }}">

        <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}"/>

        <link rel="stylesheet"href="{{ asset('assets/css/import.css')}}"/>

        <!-- Scripts -->
        @if(auth()->check())
            @routes
        @else
            @routes(['guest'])
        @endif

        @vite('resources/js/app.js')
        @inertiaHead
        @laravelPWA
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <!--plugins-->
        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
        <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

        <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>

    </body>
</html>
