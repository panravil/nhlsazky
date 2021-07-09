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
    <meta name="googlebot" content="index,follow"/>
    <meta name="robots" content="index,follow"/>
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
  <script type="text/javascript">
        window.cookieconsent_options = {
            "message": "Tento web používá k poskytování služeb, personalizaci reklam a analýze návštěvnosti soubory cookie. Používáním tohoto webu s tím souhlasíte.",
            "dismiss": "Rozumím",
            "learnMore": "",
            "link": null,
            "theme": "dark-bottom"
        };

    </script>

    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>

    <!-- End Cookie Consent plugin -->
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '693492421205432');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=693492421205432&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['BarionAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://pixel.barion.com/bp.js', 'bp');

        // send page view event
        bp('init', 'addBarionPixelId', 'BP-HSAy9bglTq-88');
    </script>

    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://pixel.barion.com/a.gif?__ba_pixel_id=BP-HSAy9bglTq-88&ev=contentView&noscript=1"/>
    </noscript>
</head>
<body id="page-top" style="display: flex; min-height: 100vh; flex-direction: column;">

<script>

    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {

            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');


    ga('create', 'UA-126770634-1', 'auto');

    ga('send', 'pageview');


</script>
@include('clean.layouts.navbar')
<div id="app">
    @yield('page')
</div>
@include('clean.layouts.footer')
@yield('javascripts')
@include('auth.loginModal')
@auth()
    @foreach(\Illuminate\Support\Facades\Auth::user()->subscriptionsValid as $sub)
        @if(\Carbon\Carbon::today()->diffInDays($sub->to) < 3)
            @include('front.layout.submodal', $sub)
        @endif
    @endforeach
@endauth
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/CSSRulePlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/Draggable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/EaselPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/MotionPathPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/TextPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/EasePack.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
