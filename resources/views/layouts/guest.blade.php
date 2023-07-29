<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link rel="stylesheet" as="style" rel="preload" href="/fonts/raleway.css">

        @if (isset($metas))
            {{ $metas }}
        @else
            <title>{{ config('app.name', 'Laravel') }} Improve site backlink rank and SEO with links</title>
            <meta name="description" content="{{ config('app.name', 'Laravel') }} - Improve your site backlink rank with do follow links within SEO crafted keyword focussed articles">
            <meta property="og:title" content="{{ config('app.name', 'Laravel') }} - Improve your site back link rank with do follow links">
            <meta property="og:description" content="{{ config('app.name', 'Laravel') }} - Improve your site backlink rank with do follow links within SEO crafted keyword focussed articles">
            <meta name="twitter:title" content="{{ config('app.name') }} - Improve your site back link rank with do follow links"> 
            <meta name="twitter:description" content="{{ config('app.name', 'Laravel') }} - Improve your site backlink rank with do follow links within SEO crafted keyword focussed articles">
            <link rel="canonical" href="{{ url()->current() }}">
        @endif

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Raleway:wght@400;600;700&display=swap">

        <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
        <meta property="fb:app_id" content="922287792432753">

        <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}" />
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ config('app.url') }}/images/og-image.png">
        <meta property="og:image:alt" content="{{ config('app.name') }} logo">
        <meta property="og:image:width" content="1600">
        <meta property="og:image:height" content="1200">
        <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">
        <link rel="alternate" hreflang="en" href="{{ url()->current() }}">
        <link rel="preload" as="script" href="@livewireScriptPath">
        <meta name="author" content="David Wright">
        
        <meta name="twitter:card" content="summary"> 
        <meta name="twitter:site" content="@electricautosuk"> 
        <meta name="twitter:image" content="{{ config('app.url') }}/images/og-image.png">

        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
        <link rel="manifest" href="/icons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
                
        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'])
        <style>[x-cloak] { display: none !important; }</style>
        @if (isset($headers))
            {{ $headers }}
        @endif
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
