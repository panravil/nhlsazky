<?php


session_start();

require_once 'inc/dibi.min.php';

require_once 'inc/db_connection.php';

require_once 'inc/core.php';


require_once 'api/core/core.php';

require_once 'inc/login.php';

require_once 'inc/onlinestatus.php';

header('Cache-Control: no-cache');
header('Pragma: no-cache');
header('mixed-content: noupgrade');


$logged_in = checkLogin();

$keywords_sql = dibi::fetch("SELECT hodnota FROM nastaveni WHERE zkratka = 'keywords' LIMIT 1");

$keywords = $keywords_sql['hodnota'];

$description_sql = dibi::fetch("SELECT hodnota FROM nastaveni WHERE zkratka = 'popis' LIMIT 1");

$description = $description_sql['hodnota'];

$uziv = dibi::fetch("SELECT id, admin FROM users WHERE id = %i", $_SESSION['idses']);
if ($uziv['admin'] != 1) {
    if ($uziv['id'] != 10197) {
        header('Location: https://nhlsazeni.cz/countdown/', true, 302);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="XKOXHmn4GBIgBXkthCkArb66oAYEDBP4G2A4D9Zs"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content=“sázkař,sázky,sázení,sázka,kurzy,sázkové,poradenství,investice,nhl,tip,tipy,tips,betting,hokej“/>
    <meta name="description"
          content="Inspirujte se tipy na NHL, diskutujte při live sázkách a vydělávejte desetitisíce měsíčně."/>
    <meta name="author" content="NHLSAZENI.CZ | Sázkové poradenství"/>
    <meta name="googlebot" content="index,follow,snippet,archive"/>
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
    <link rel="apple-touch-icon" href="http://localhost:8000/images/icons/icon-512x512.png">
    <link rel="icon" href="http://localhost:8000/images/icons/icon-32x32.png" sizes="32x32">
    <link rel="icon" href="http://localhost:8000/images/icons/icon-96x96.png" sizes="96x96">
    <link rel="icon" href="http://localhost:8000/images/icons/icon-128x128.png" sizes="128x128">
    <link rel="icon" sizes="512x512" href="http://localhost:8000/images/icons/icon-512x512.png">
    <meta name="msapplication-TileColor" content="#212121">
    <meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">
    <title>NHL Sázení</title>

        <link href="https://fonts.googleapis.com/css@family=Roboto&amp;display=swap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css@family=Nunito+Sans&amp;display=swap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css@family=Nunito+Sans&amp;display=swap.css" rel="stylesheet">
    <link href="css/app.css@id=1065343b081d6bdfce93.css" rel="stylesheet">

    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    
</head>
<body id="page-top" style="display: flex; min-height: 100vh; flex-direction: column;">
<div class="container-fluid d-none">
    <div class="row no-gutters">
        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
            <div class="card" style="border-radius: 0px">
                <div class="d-flex flex-row justify-content-around">
                    <span class="">22:00 2. 10.</span>
                </div>
                <div class="d-flex flex-row justify-content-between mx-1 align-items-center">
                    <img src="images/assets/teams/5.png@re" alt="Columbus Blue Jackets" title="Columbus Blue Jackets"
                         height="45px">
                    <div class="score px-1 d-flex flex-nowrap justify-content-center align-items-center"
                         style="font-size: 1.5rem; font-weight: 800;">
                        <span>3</span>
                        <span>:</span>
                        <span>1</span>
                    </div>
                    <img src="images/assets/teams/6.png@re" alt="Columbus Blue Jackets" title="Columbus Blue Jackets"
                         height="45px">
                </div>
            </div>
        </div>

        <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
            <div class="card" style="border-radius: 0px">
                <div class="d-flex flex-row justify-content-around">
                    <span class="">22:00 2. 10.</span>
                </div>
                <div class="d-flex flex-row justify-content-between mx-1 align-items-center">
                    <img src="images/assets/teams/5.png@re" alt="Columbus Blue Jackets" title="Columbus Blue Jackets"
                         height="45px">
                    <div class="score px-1 d-flex flex-nowrap justify-content-center align-items-center"
                         style="font-size: 1.5rem; font-weight: 800;">
                        <span>3</span>
                        <span>:</span>
                        <span>1</span>
                    </div>
                    <img src="images/assets/teams/6.png@re" alt="Columbus Blue Jackets" title="Columbus Blue Jackets"
                         height="45px">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="topbar bg-primary" style="z-index: 1">
    <div class="container d-none d-md-flex">
                    <ul class="nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost:8000/login"><i class="fas fa-sign-in-alt"></i> Přihlásit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost:8000/register"><i class="fas fa-user-plus"></i> Registrovat</a>
                </li>
            </ul>
            </div>
</div>

<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-lg">
    <div class="container-fluid container-lg">
        <a class="navbar-brand" style="z-index: 100" href="index.html">
            <img src="images/assets/logo.png" alt="Logo" style="  -webkit-filter: drop-shadow(5px 5px 5px #222 );
  filter: drop-shadow(0 1rem 3rem rgba(0,0,0,0.175));" class="img-responsive">
        </a>
        <button class="navbar-toggler collapsed ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">DOMŮ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="http://localhost:8000/o-mne">O MNĚ</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="http://localhost:8000/premium">PREMIUM TIPY</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="http://localhost:8000/statistiky">STATISTIKY</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="http://localhost:8000/soutez">SOUTEŽ</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="http://localhost:8000/kontakt">KONTAKT</a>
                </li>
            </ul>
            <div class="d-block d-md-none">
                            <ul class="navbar-nav ml-auto text-center d-md-none">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/login">Přihlásit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8000/register">Registrovat</a>
                    </li>
                </ul>
                            </div>
        </div>
    </div>
</nav>
    <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner carousel-fade" role="listbox">
            <div id="puck_carousel" class="carousel-item active"
                 style="background-image: linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6) ),url('images/assets/led-katok-carapiny-linii.jpg')">
                <div
                    class="container d-flex flex-row flex-wrap flex-wrap-reverse align-items-center h-100">
                    <div class="col-12 col-md-6">
                        <h3 class="pucks_text featurette-heading">Nejdéle působící sázkové poradenství v Česku a na Slovensku  Since 2014.
                        </h3>
                        <p class="pucks_text lead">Přidej se k nám a začni taky sázením konečně opravdu vydělávat.</p>
                        <a href="index.html#o-mne" data-anchor="#o-mne" class="btn btn-lg rounded btn-primary shadow-lg">Přečti si můj příběh</a>
                    </div>
                        <img id="stankos" src="images/assets/Stankos2.png" class="d-none d-md-block img-fluid">
                </div>
            </div>
            <div class="carousel-item"
                 style="background-image: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ),url('images/assets/led-katok-carapiny-linii.jpg')">
                <div
                    class="container d-flex flex-row flex-wrap flex-wrap-reverse align-items-center h-100 justify-content-center">
                    <div class="col-6 d-none d-md-block col-md-5">
                        <img src="images/assets/puck.png" class="img-fluid puck">
                    </div>
                    <div class="col-12 col-md-7">
                        <h2 class="pucks_text featurette-heading">Přes <b>1&nbsp;000&nbsp;000</b> vydělaných korun od
                            spuštění projektu.
                        </h2>
                        <p class="pucks_text lead">Mrkni na historii a statistiky všech mých zveřejněných tipů od roku 2014.</p>
                        <a href="http://localhost:8000/statistiky" class="btn btn-lg w-50 rounded btn-light shadow-lg">STATISTIKY</a>
                    </div>
                </div>
            </div>
              <div class="carousel-item"
                 style="background-image: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ),url('images/assets/led-katok-carapiny-linii.jpg')">
                <div
                    class="container d-flex flex-row flex-wrap flex-wrap-reverse align-items-center h-100 justify-content-center">
                    <div class=" d-none d-md-block col-6 col-md-5">
                        <img src="images/assets/puck.png" class="img-fluid puck">
                    </div>
                    <div class="col-12 col-md-7">
                        <h2 class="pucks_text featurette-heading">Přes <b>1&nbsp;000&nbsp;000</b> vydělaných korun od
                            spuštění projektu.
                        </h2>
                        <p class="pucks_text lead">Mrkni na historii a statistiky všech mých zveřejněných tipů od roku 2014.</p>
                        <a href="http://localhost:8000/statistiky" class="btn btn-lg w-50 rounded btn-light shadow-lg">STATISTIKY</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="index.html#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="index.html#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
<div class="skew-header"></div>
    </div>

</header>

    <section id="o-mne">
    <div class="container marketing">

        <div class="row d-flex flex-row justify-space-between align-items-center">
            <div class="col-md-7">
                <h3 class="puck_text featurette-heading">Můj příběh.
                </h3>
                <p class="puck_text" style="font-size: 1.1rem">Vše začalo před několika lety, kdy jsem své sázení zaměřil pouze na <b>NHL</b>.
                    Rozhodl jsem se zápasy každou noc sledovat, přes den je analyzovat a večer sázet. Úspěch v podobě
                    krásných výdělků mě hodně motivoval a dnes si sázením vydělávám i desetitisíce měsíčně. <b>Od roku 2014</b>
                    máte možnost vydělávat společně se mnou. <b>Stačí Vám 5 minut</b> každý den na netu a mít účet u kterékoliv
                    sázkové kanceláře.
                </p>
            </div>
            <div class="col-md-5">
                <img id="puck" src="images/assets/cup.png" class="img-fluid puck px-4">
            </div>
        </div>
    </div>
</section>
<div class="skew-c-dark-black"></div>
<section class="bg-secondary">
    <div class="container">
        <div class="row d-flex flex-row justify-space-between align-items-center">
            <div class="col-md-7 order-md-2">
                <h3 class="cup_text featurette-heading">Vyděláváme sázením <b>NHL</b> zápasů
                </h3>
                <p class="cup_text lead">Své úspěšné tipy na NHL s Vámi sdílím už od roku 2014, kdy jsem projekt NHL Sázení založil a od té doby jste se mnou mohli vydělat už přes 1 000 000 Kč. Díky dlouhodobé úspěšnosti a stovkám pravidelně spokojených klientů projekt funguje už přes 6 let a to samo o sobě značí, jak moc jsem oproti konkurenci úspěšný. Denně klientům prostřednictvím e-mailu zveřejňuji 2-8 tipů na NHL s průměrným kurzem 2.45 a dostatečnou časovou rezervou. Každý den věnuji analýzám zápasů několik hodin a každou noc na svých monitorech pozoruji až 8 hrajících se zápasů najednou. Chceš se o mé úspěšnosti přesvědčit sám? Přidej se ještě dnes a začni sázením konečně vydělávat taky, stačí ti k tomu 2 minuty času každý večer.
</p>
            </div>
            <div class="col-md-5 order-md-1">

                <img id="cup" style="max-height: 50vh" src="images/assets/puck.png" class="img-fluid p-5 p-md-0">
            </div>
        </div>
    </div><!-- /.container -->

<div class="skew-cc-dark-black"></div>
</section>
    <section>
    <div class="container my-3 my-md-4">
      <div class="row">
        <br/>
        <div class="col text-center">
          <h2>Historie v číslech</h2>
          <p>counter to count up to a target number</p>
        </div>

      </div>
      <div class="row text-center" id="counters">
        <div class="col-6 col-md-3 col-lg">
          <div class="counter">
            <i class="fas fa-clipboard-list fa-2x"></i>
            <h2 id="tip_count" class="timer count-title count_number" data-to="100" data-speed="1500"><span>3304</span>
            </h2>
            <p class="count-text ">Tipů</p>
          </div>
        </div>
        <div class="col-6 col-md-3 col-lg">
          <div class="counter">
            <i class="fas fa-clipboard-check fa-2x"></i>
            <h2 class="timer count-title count_number" data-to="157" data-speed="1500"><span>1823</span></h2>
            <p class="count-text ">Úspěšných tipů</p>
          </div>
        </div>
        <div class="d-none d-lg-block col-lg">
          <div class="counter">
            <i class="fas fa-thumbs-up fa-2x"></i>
            <h2 id="avg_odd" class="timer count-title count_number_decimal" data-to="1700" data-speed="1500"><span>2.01</span>
            </h2>
            <p class="count-text ">Průměrný kurz</p>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg">
          <div class="counter">
            <i class="fas fa-piggy-bank fa-2x"></i>
            <h2 class="timer count-title count_number" data-to="11900" data-speed="1500"><span>1439895</span> Kč</h2>
            <p class="count-text ">Čitý získ</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card bg-primary text-dark shadow" id="calculator">
                <div
                    class="card-header bg-primary d-flex flex-row justify-content-between align-content-center align-items-center">

                    <h4 class="text-white m-0 text-uppercase">Kalkulačka
                        výher</h4>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="currency" value="Kč" id="option1" checked> Kč
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="currency" value="€" id="option2"> €
                        </label>
                    </div>

                </div>
                <div class="card-body m-1 m-md-2 bg-white rounded">
                    <div id="slidecontainer">
                        <div class="d-flex flex-row justify-content-between align-items-end">
                            <label for="customRange1" class="h4 d-none d-md-block">Průměrná sázka:</label>
                            <label for="customRange1" class="h5 d-block d-md-none">Průměrná sázka:</label>
                            <div><span id="f" class="text-primary h2" style="font-weight:bold">100</span> <span
                                    class="h2">Kč</span></div>
                        </div>
                        <input type="range" class="custom-range" id="customRange1" min="100" step="100" max="5000"
                               value="500">
                        <div class="d-flex flex-row justify-content-between align-items-center">
                            <label for="membership-toggle" class="h4 m-0">Délka členství:</label>
                            <div class="btn-group btn-group-toggle rounded shadow" id="membership-toggle"
                                 data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    <input type="radio" name="duration" value="10" id="option1" checked>10 dní
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="duration" value="30" id="option2">30 dmí
                                </label>

                                <label class="btn btn-primary">
                                    <input type="radio" name="duration" value="season" id="option2">Celá sezona
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-content-center align-items-center mt-4">
                        <div class="text-left">
                            <p class="m-0"><span id="days" class="text-primary h3" style="font-weight:bold">100</span>
                                <span
                                    class="h3">Kč</span></p>
                            <label for="result" class="h4">Za 10 dní</label>
                        </div>
                        <div class="text-right">
                            <p class="m-0"><span id="month" class="text-primary h3" style="font-weight:bold">100</span>
                                <span
                                    class="h3">Kč</span></p>
                            <label for="result" class="h4">Za 30 dní</label>
                        </div>
                    </div>

                    <div class="text-center d">
                        <p class="m-0"><span id="season" class="text-primary h1 count_number" style="font-weight:bold"></span>
                            <span
                                class="h1">Kč</span></p>
                        <label for="result" class="h3">Za sezónu</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <div id="calculator_card" class="card bg-secondary my-3 my-md-0">
                <div class="card-body">
                    <h4 class="card-title">Zjitětě kolik můžete vydělat </h4>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">Zadej částku, za kterou běžně sázíš nebo chceš sázet a kalkulačka ti podle
                        historie tipů a statistik vypočte reálný zisk, který si se mnou můžeš za 30 dní průměrně
                        vydělat. </p><p>Zisk může být samozřejmě trochu vyšší nebo nižší, záleží na úspěšnosti v daném měsíci,
                        ale díky datům od roku 2014 je výsledná částka hodně přesná.</p>
                </div>
            </div>
                <div class="d-flex justify-space-between mb-3">
                    <a href="http://localhost:8000/premium" class="card-link btn btn-lg btn-block rounded btn-primary my-3 px-3">Stát se členem</a>
                    <a href="http://localhost:8000/statistiky" class="card-link btn btn-lg rounded btn-light  my-3 ml-3">Statistiky</a>

                </div>
        </div>
    </div>
</div>

<div class="skew-cc-black-dark"></div>
</section>
    <section class="pt-5 pb-5 bg-secondary news">
    <div class="container">
        <div class="row d-flex">
            <div class="col-12">
                <h3 class="mb-2 text-center">Novinky z NHL</h3>
            </div>
            <div id="carousel-example-generic" class="carousel multi slide" data-ride="carousel" data-itemcount-l="4"
                 data-itemcount-m="3" data-itemcount-s="2" autostart="0">
                <div class="carousel-inner mx-1" role="listbox">

                    
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/nuda-a-osm-mesicu-cekani-jsme-pripraveni-hlasi-nejen-z-anaheimu/5022539" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Fcam-fowler-anaheim-ducks-ana.jpeg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">18. 11. 2020 - 14:00</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Nuda a osm měsíců čekání. Jsme připravení, hlásí (nejen) z Anaheimu</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/skvela-zprava-operovane-koleno-drzi-hertl-brusli-trikrat-tydne-a-rika-z-fleku-muzu-hrat-zapasy/5022538" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Fhertl-hattrick-again.jpg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">18. 11. 2020 - 12:00</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Skvělá zpráva, operované koleno drží! Hertl bruslí třikrát týdně a říká: Z fleku můžu hrát zápasy</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/uprednostnil-rusko-pred-nhl-udelal-morozov-dobre/5022537" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Fmorozov.jpg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">18. 11. 2020 - 10:00</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Upřednostnil Rusko před NHL. Udělal Morozov dobře?</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/skauting-behem-korony-je-to-vyzva-rika-gm-flames/5022536" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Fbrad-treliving-cgy-05-01-20.jpg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">18. 11. 2020 - 04:38</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Skauting během korony? Je to výzva, říká GM Flames</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/nhl-zbystri-dostal-kraluje-ve-finsku-kdy-dostane-sanci-od-anaheimu/5022535" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Fdostal-lukas-ilves-fin-0404-04.jpg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">17. 11. 2020 - 19:20</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">NHL, zbystři! Dostál kraluje ve Finsku, kdy dostane šanci od Anaheimu?</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/ottawa-vyhlizi-lepsi-zitrky-nas-cas-prijde-v-nasledujicich-trech-letech-veri-majitel/5022534" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Feugene-melnyk-owner-ott.jpg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">17. 11. 2020 - 13:30</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Ottawa vyhlíží lepší zítřky. Náš čas přijde v následujících třech letech, věří majitel</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/nejvic-se-vyplati-pastrnak-ceska-superhvezda-opet-kraluje-nhl-bostonu-usetri-26-milionu/5022533" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F62%252Fdavid-pastrnak-88632997.png); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">17. 11. 2020 - 10:00</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Nejvíc se vyplatí Pastrňák. Česká superhvězda opět kraluje NHL, Bostonu ušetří 26 milionů</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="http://novy.nhl.cz/osmicka-draftu-se-dockala-vstupni-smlouvy-quinn-ma-pred-sebou-tezke-rozhodovani-o-dalsim-kroku/5022532" target="_blank"
                           class="card article rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(proxy@url%255B0%255D=http%253A%252F%252Fnovy.nhl.cz%252Ffiles%252Fimages%252F57%252Fquinn-jack.jpg); background-size: cover"><div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">17. 11. 2020 - 06:16</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">Osmička draftu se dočkala vstupní smlouvy. Quinn má před sebou těžké rozhodování o dalším kroku</h3>
                                </div>
                            </div>
                        </a>
                    </div>                    <a class="left carousel-control" href="index.html#carousel-example-generic" role="button" data-slide="prev">
                        <span class="icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="index.html#carousel-example-generic" role="button" data-slide="next">
                        <span class="icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
            </div>
        </div>
    </div>

<div class="skew-cc-dark-black"></div>
</section>

    <section class="pt-5 pb-5 testimonials">
    <div class="container">
                      <div class="row">
        <br/>
        <div class="col text-center">
          <h2>Reference</h2>
          <p>Od roku 2014 se do projektu zapojilo spousta</p>
        </div>

      </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 my-1 py-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex flex-row justify-space-between">Dominik P. <div class="ml-auto rating">
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-light"></i></span>
                        </div></h4>
                        <h6 class="card-subtitle mb-2 text-muted">20. 7. 2018</h6>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                erat a ante.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
<div class="col-sm-12 col-md-6 col-lg-4 my-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title d-flex flex-row justify-space-between">Frantisek S. <div class="ml-auto rating">
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                        </div></h4>
                        <h6 class="card-subtitle mb-2 text-muted">20. 7. 2018</h6>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                erat a ante.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                erat a ante.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 d-md-none d-lg-block col-lg-4 my-1 py-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex flex-row justify-space-between">Dominik P. <div class="ml-auto rating">
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-primary"></i></span>
                            <span><i
                                    class="fas fa-hockey-puck text-light"></i></span>
                        </div></h4>
                        <h6 class="card-subtitle mb-2 text-muted">20. 7. 2018</h6>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                erat a ante.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="bg-black">
    <div class="container">

        <!-- For demo purpose -->
        <div class="row pb-5">
            <div class="col-lg-9 mx-auto text-white text-center">
                <h1 class="h2">Často kladené otázky</h1>
                <p class="lead mb-0">Neváhajete nás kontaktovat pokud zde nenajdete odpověd na vaši otázku.</p>
            </div>
        </div><!-- End -->

        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-4 col-lg-3 col-xl-2 text-center">
                <ul class="list-unstyled d-inline-flex d-md-block">
                    <li>
                        <a href="index.html#" class="btn btn-link p-0 p-md-2"><i class="fab fa-instagram fa-fw fa-5x"></i></a>
                    </li>
                    <li>
                        <a href="index.html#" class="btn btn-link p-0 p-md-2"><i class="fab fa-telegram-plane fa-fw fa-5x"></i></a>
                    </li>
                    <li>
                        <a href="index.html#" class="btn btn-link p-0 p-md-2"><i class="fas fa-envelope fa-fw fa-5x"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8 col-lg-9 col-xl-7">
                <!-- Accordion -->
                <div id="accordionExample" class="accordion shadow">


                    <div class="card bg-dark shadow-lg">
                        <div id="headingOne" class="card-header shadow-sm border-0">
                            <h5 class="mb-0">
                                <a href="index.html#" type="button" data-toggle="collapse" data-target="#collapseOne"
                                   aria-expanded="true"
                                   aria-controls="collapseOne"
                                   class="btn btn-link font-weight-bold text-uppercase collapsible-link">Kolik si
                                    sázením NHL zápasů vyděláš měsíčně?
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample"
                             class="collapse show">
                            <div class="card-body p-4">
                                <p class="font-weight-light m-0">
                                    Měsíčne si sázením NHL zápasů vydělám v průměru 55 000 Kč (každý měsíc je samozřejmě
                                    jiný).</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 2 -->
                    <div class="card bg-dark">
                        <div id="headingTwo" class="card-header shadow-sm border-0">
                            <h5 class="mb-0">
                                <a href="index.html#" type="button" data-toggle="collapse" data-target="#collapseTwo"
                                   aria-expanded="false"
                                   aria-controls="collapseTwo"
                                   class="btn btn-link collapsed font-weight-bold text-uppercase collapsible-link">
                                    Mohu s tebou sázet, ikdyž sázení ani hokeji vůbec nerozumím?
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample"
                             class="collapse">
                            <div class="card-body p-4">
                                <p class="font-weight-light m-0">Ano můžeš, veškerou analytickou práci dělám já. Ty ode
                                    mě pouze
                                    obdržíš notifikaci s dostatečným šasovým předstihem, který zápas, za kolik a jak máš
                                    vsadit. Mezi mé
                                    klienty patří studenti, podnikatelé i ženy na mateřské.</p>
                            </div>
                        </div>
                    </div><!-- End -->

                    <!-- Accordion item 3 -->
                    <div class="card">
                        <div id="headingThree" class="card-header shadow-sm border-0">
                            <h5 class="mb-0">
                                <a href="index.html#" type="button" data-toggle="collapse" data-target="#collapseThree"
                                   aria-expanded="false"
                                   aria-controls="collapseThree"
                                   class="btn btn-link collapsed font-weight-bold text-uppercase collapsible-link">
                                    U které sázkové kanceláře sázíš?
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample"
                             class="collapse">
                            <div class="card-body p-4">
                                <p class="font-weight-light m-0">Mám účet u více sázkovek a vždy sázím tam, kde je
                                    zrovna nejvyšší
                                    kurz.</p>
                            </div>
                        </div>
                    </div><!-- End -->
                    <div class="card">
                        <div id="headingFour" class="card-header shadow-sm border-0">
                            <h5 class="mb-0">
                                <a href="index.html#" type="button" data-toggle="collapse" data-target="#collapseFour"
                                   aria-expanded="false"
                                   aria-controls="collapseThree"
                                   class="btn btn-link collapsed font-weight-bold text-uppercase collapsible-link">
                                    Co všechno Premium členství zahrnuje?
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample"
                             class="collapse">
                            <div class="card-body p-4">
                                <p class="font-weight-light m-0">Premium členství zahrnuje předzápasové (premium) tipy,
                                    občasné live
                                    sázky a možnou individuální konzultaci ohledně správného money managementu k
                                    efektivnímu růstu
                                    zisku.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingFive" class="card-header shadow-sm border-0">
                            <h5 class="mb-0">
                                <a href="index.html#" type="button" data-toggle="collapse" data-target="#collapseFive"
                                   aria-expanded="false"
                                   aria-controls="collapseThree"
                                   class="btn btn-link collapsed font-weight-bold text-uppercase collapsible-link">
                                    Za jak dlouho po zaplacení budu mít premium členství aktivní?
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionExample"
                             class="collapse">
                            <div class="card-body p-4">
                                <p class="font-weight-light m-0">Díky platební brány budeš mít členství aktivn uží do
                                    pár minut od zaplacení.</p>
                            </div>
                        </div>
                    </div>

                </div><!-- End -->
            </div>
        </div>
    </div>
</section>
<footer class="footer shadow-lg" style="margin-top: auto">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-10 h-100 text-center text-md-left my-auto">
                <div class="mb-2 mb-lg-0 text-white"><b>NHLsazeni</b>&nbsp;©&nbsp;2020 <span class="small"></span>.
                </div>
                <a href="http://localhost:8000/obchodni-podminky" style="text-decoration: underline">Ochrana osobních údajů</a> | <a href="http://localhost:8000/obchodni-podminky" style="text-decoration: underline">Obchodní podmínky</a>
            </div>
            <div class="col-md-2 col-lg-2 h-100 text-center text-md-right">
                <a href="index.html#" class="social">
                    <i class="fab fa-telegram-plane fa-fw"></i>
                </a>
                <a href="index.html#" class="social">
                    <i class="fab fa-instagram fa-fw"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
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
<script src="js/app.js" defer></script>
</body>

</html>
