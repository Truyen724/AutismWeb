<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="vi,en" />
    <meta name="author" content="HERO-TEAM" />

    <base href="{{ url('/') }}" />

    <title>@yield('title') - {{ config('app.name', 'TTrip Tour') }}</title>

    <meta name="keywords" content="" />
    <meta name="description" content="@yield('seo-description')" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="robots" content="">

    <meta itemprop="name" content="@yield('seo-title')">
    <meta itemprop="description" content="@yield('seo-description')">
    <meta itemprop="image" content="@yield('seo-image')">

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:description" content="@yield('seo-description')" />
    <meta name="twitter:image" content="@yield('seo-image')" />

    <meta property="og:title" content="@yield('seo-title')" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
    <meta property="og:site_name" content="" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('seo-image')" />
    <meta property="og:description" content="@yield('seo-description')" />

    <link rel="sitemap" type="application/xml" title="Sitemap: " href="{{ url('sitemap.xml') }}">
    @if (isset($setting->favicon))
        <link rel="shortcut icon" type="image/x-icon" href="/storage/{{ $setting->favicon }}">
    @endif


    {{-- Styles css common --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    @yield('style-libraries')
    {{-- Styles custom --}}
    @yield('styles')
</head>
