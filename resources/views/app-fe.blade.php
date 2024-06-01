<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Metas -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="keywords" content="Tysoft Group, software, solution, mobile app, aplikasi mobile" />
        <meta name="description" content="SI-GAP KUTIM" />
        <meta name="author" content="TSG" />

        <!-- Title  -->
        <title inertia>{{ config('app.name', 'TSG') }}</title>
        <link  rel="shortcut icon" type="image/png" href="{{ asset('fe/assets/img/logo3.svg') }}">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">

        <!-- Plugins -->
        <link rel="stylesheet"href="{{ asset('fe/assets/css/plugins.css') }}" />
        <!-- Core Style Css -->
        <link rel="stylesheet"href="{{ asset('fe/assets/css/style.css') }}" />

        <!-- Scripts -->
        @if(auth()->check())
            @routes
        @else
            @routes(['guest'])
        @endif

        @vite('resources/fe/app.js', 'build/fe')
        @inertiaHead
        @laravelPWA
    </head>
    <body class="land-demo2">
        @inertia

		<!-- jQuery -->
		<script src="{{ asset('fe/assets/js/jquery-3.6.0.min.js') }}"></script>
		<script src="{{ asset('fe/assets/js/jquery-migrate-3.4.0.min.js') }}"></script>

		<!-- plugins -->
		<script src="{{ asset('fe/assets/js/plugins.js') }}"></script>

        <script src="{{ asset('fe/assets/js/particles.min.js') }}"></script>

		<!-- custom scripts -->
		{{-- <script src="{{ asset('fe/assets/js/scripts.js') }}"></script> --}}
    </body>
</html>
