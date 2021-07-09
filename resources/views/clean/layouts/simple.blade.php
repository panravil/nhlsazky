<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content=“sázkař,sázky,sázení,sázka,kurzy,sázkové,poradenství,investice,nhl,tip,tipy,tips,betting,hokej“/>
    <meta name="description"
          content="Inspirujte se tipy na NHL, diskutujte při live sázkách a vydělávejte desetitisíce měsíčně."/>
    <meta name="author" content="NHLSAZENI.CZ | Sázkové poradenství"/>
    <meta name="googlebot" content="noindex,nofollow"/>
    <meta name="robots" content="noindex,nofollow"/>
    <meta name="og:title" content="NHLSAZENI.CZ | Sázkové poradenství"/>
    <meta name="og:description"
          content="Nejlepší sázkové poradenství v ČR a SK. Inspirujte se mými tipy na NHL a vydělávejte až desetitisíce měsíčně."/>

    <meta name="og:image" content="https://nhlsazeni.cz/images/nhlsazenicz.png"/>

    <meta property="og:site_name" content="NHLSAZENI.CZ| Sázkové poradenství">

    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#257de7">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="NHLSazeni">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#212121">
    <meta name="apple-mobile-web-app-title" content="NHL Sazeni">
    <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">
    <link rel="icon" href="/images/icons/icon-32x32.png" sizes="32x32">
    <link rel="icon" href="/images/icons/icon-96x96.png" sizes="96x96">
    <link rel="icon" href="/images/icons/icon-128x128.png" sizes="128x128">
    <link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">
    <meta name="msapplication-TileColor" content="#212121">
    <meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">
    <title>@yield('title', 'NHL Sázení')</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


@yield('styles')

    @yield('styles')

</head>
<body id="page-top" style="display: flex; min-height: 100vh; flex-direction: column;">
<div class="nav">
    <img src="https://nhlsazeni.cz/logo.png" alt="NHL Sázení">
</div>
@yield('page')
@include('clean.layouts.footer')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
</body>

</html>
