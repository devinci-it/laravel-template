<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('vendor/pagination/pagination.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/icons/favicon.svg') }}">
    <title>@yield('title')</title>

    @if(app()->environment('local'))
        <!-- Vite's development server provides assets in development -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])   @else
        <!-- In production, the assets are resolved through Vite's manifest -->
        @vite(['resources/js/app.js', 'vendor/courier/build'])    @endif
</head>
