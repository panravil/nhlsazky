<!DOCTYPE html>
<html>
<html lang="cs">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta name="keywords"
          content=“sázkař,sázky,sázení,sázka,kurzy,sázkové,poradenství,investice,nhl,tip,tipy,tips,betting,hokej“/>

    <meta name="description"
          content="Inspirujte se tipy na NHL, diskutujte při live sázkách a vydělávejte desetitisíce měsíčně."/>
    <link rel="canonical" href="https://www.nhlsazeni.cz/"/>
    <meta name="author" content="NHLSAZENI.CZ | Sázkové poradenství"/>

    <meta name="googlebot" content="snippet, archive, nofoolow, index"/>

    <meta name="robots" content="index, nofollow"/>

    <meta name="og:title" content="NHLSAZENI.CZ | Sázkové poradenství"/>

    <meta name="og:description"
          content="Nejlepší sázkové poradenství v ČR a SK. Inspirujte se mými tipy na NHL a vydělávejte až desetitisíce měsíčně."/>

    <meta name="og:image" content="https://nhlsazeni.cz/images/nhlsazenicz.png"/>

    <meta property="og:site_name" content="NHLSAZENI.CZ| Sázkové poradenství">

    <meta property="og:url" content="https://nhlsazeni.cz/">
    <!-- Web Application Manifest -->
    <link rel="manifest" href="https://nhlsazeni.cz/manifest.json">
    <!-- Chrome for Android theme color -->
    <meta name="theme-color" content="#212121">
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
    <title>NHL Sázení</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
    <link rel="stylesheet" type="text/css" href="./countdown/style2.css?v11">
</head>

<body>
<div class="nav">
    <img src="https://nhlsazeni.cz/logo.png" alt="NHL Sázení">
</div>
<video id="preVideo" src="./countdown/nhlsazeniCUP.mp4" playsinline preload="auto" muted="true" loop="true">
</video>
<a href="#" id="btn" class="cta-banner">
    <div class="card-body d-flex flex-column flex-md-row align-items-center">
        <div class="card-img" style="height: 2rem; overflow: visible;">
            <img id="" src="/countdown/cup.png" style="height: 180px;
    position: absolute;
    /* top: 0; */
    bottom: 0.3rem;
    height: 210px;
    max-width: 100%;
    left: 0; -webkit-filter: drop-shadow(0px 10px 10px black);
    filter: drop-shadow(0px 10px 10px black );" class="img-fluid">
        </div>
        <div class="card-text">
            <p class="text-white m-0 lead">Prodej <b>EXTRA</b> zvýhodněného balíčku<br class="d-none d-md-block">tipů na <b>sezónu&nbsp;2021</b> zahájen.</p>
        </div>
        <div class="card-btn">
            <div href="#" class="btn-white">ZÍSKAT&nbsp;SEZONNÍ BALÍČEK</div>
        </div>
    </div>
</a>
<div id="modal" class="modal">
    <div id="card" class="card">
        <img src="./images/assets/promo-obrazek.jpg" style="width: 100%; height: auto;"/>
        <h1 style="text-transform: uppercase">{{ $event->title }}</h1>
        <div class="event">
            {!! $event->html_template !!}
        </div>

    </div>
</div>
<footer>
    <h2>Do další sezóny zbývá:</h2>
    <ul id="countdown">
        <li id="days">
            <div class="number">00</div>
            <div class="label">Dní</div>
        </li>
        <li id="hours">
            <div class="number">00</div>
            <div class="label">Hodin</div>
        </li>
        <li id="minutes">
            <div class="number">00</div>
            <div class="label">Minut</div>
        </li>
        <li id="seconds">
            <div class="number">00</div>
            <div class="label">Vteřin</div>
        </li>
    </ul>
    <h3 class="text-muted"><a href="mailto:nhlsazeni@gmail.com">nhlsazeni@gmail.com</a></h3>
</footer>

<script>
    var targetDate = new Date("2021/1/13 00:00:00");

    var days;
    var hrs;
    var min;
    var sec;

    $(function () {
        timeToLaunch();
        numberTransition('#days .number', days, 1000, 'easeOutQuad');
        numberTransition('#hours .number', hrs, 1000, 'easeOutQuad');
        numberTransition('#minutes .number', min, 1000, 'easeOutQuad');
        numberTransition('#seconds .number', sec, 1000, 'easeOutQuad');
        setTimeout(countDownTimer, 1001);
    });

    function timeToLaunch() {
        var currentDate = new Date();

        var diff = (currentDate - targetDate) / 1000;
        var diff = Math.abs(Math.floor(diff));

        days = Math.floor(diff / (24 * 60 * 60));
        sec = diff - days * 24 * 60 * 60;

        hrs = Math.floor(sec / (60 * 60));
        sec = sec - hrs * 60 * 60;

        min = Math.floor(sec / (60));
        sec = sec - min * 60;
    }

    function countDownTimer() {
        timeToLaunch();
        $("#days .number").text(days);
        $("#hours .number").text(hrs);
        $("#minutes .number").text(min);
        $("#seconds .number").text(sec);
        setTimeout(countDownTimer, 1000);
    }

    function numberTransition(id, endPoint, transitionDuration, transitionEase) {
        $({
            numberCount: $(id).text()
        }).animate({
            numberCount: endPoint
        }, {
            duration: transitionDuration,
            easing: transitionEase,
            step: function () {
                $(id).text(Math.floor(this.numberCount));
            },
            complete: function () {
                $(id).text(this.numberCount);
            }
        });
    };
</script>

<script type='text/javascript'>

    var btn = document.getElementById('btn');
    var modal = document.getElementById('modal');
    var card = document.getElementById('card');
    btn.addEventListener('click', () => {
        modal.classList.add('show');
    })

    modal.addEventListener('click', () => {
        modal.classList.remove('show');
    })

    card.addEventListener('click', (event) => {
        event.stopPropagation();
    })

    var video = document.getElementById('preVideo');
    video = document.getElementById('preVideo');
    let autoPlayAllowed = true;

    const promise = video.play();

    if (promise instanceof Promise) {
        promise.catch(function (error) {
            console.log(error.message);
            // Check if it is the right error
            if (error.name === 'NotAllowedError') {
                autoPlayAllowed = false;
            } else {
                // Don't throw the error so that we get to the then
                // or throw it but set the autoPlayAllowed to true in here
            }
        }).then(function () {
            if (autoPlayAllowed) {
                console.log('autoplay allowed')
            } else {
                console.log('autoplay NOT allowed')
            }
        });
    } else {
        // Unknown if allowed
        // Note: you could fallback to simple event listeners in this case
        console.log('autoplay unknown')
    }
</script>

</body>

</html>
