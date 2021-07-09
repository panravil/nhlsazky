<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner carousel-fade" role="listbox">
            <div id="puck_carousel" class="carousel-item active"
                 style="background-image: url('/images/assets/1.jpg')">
                <div
                    class="container d-flex flex-row flex-wrap flex-wrap-reverse align-items-center h-100">
                    <div class="col-12 col-md-8 offset-md-2 text-center">
                        <h2 class="pucks_text featurette-heading font-weight-light"><b>Nejdéle</b> působící sázkové poradenství v <b>Česku a na Slovensku</b>  Since <b>2014</b>.
                        </h2>
                        <p class="pucks_text lead">Přidej se k nám a začni taky sázením konečně opravdu vydělávat.</p>
                        <a href="#o-mne" data-anchor="#o-mne" class="btn btn-lg text-uppercase rounded btn-primary shadow-lg">ZJISTIT VÍCE</a>
                    </div>

                </div>
            </div>
            <div class="carousel-item"
                 style="background-image: url('/images/assets/2.jpg')">
                <div
                    class="container d-flex flex-row flex-wrap flex-wrap-reverse align-items-center h-100 justify-content-center">
                    <div class="col-12 col-md-7  offset-md-5">
                        <h2 class="pucks_text featurette-heading">Přes <b>1&nbsp;000&nbsp;000</b> vydělaných korun od
                            spuštění projektu.
                        </h2>
                        <p class="pucks_text lead">Mrkni na historii a statistiky všech mých zveřejněných tipů od roku 2014.</p>
                        <a href="{{ route('statsGlobal') }}" class="btn btn-lg w-50 rounded btn-light shadow-lg">STATISTIKY</a>
                    </div>
                </div>
            </div>
              <div class="carousel-item"
                 style="background-image: url('/images/assets/3.jpg')">
                <div
                    class="container d-flex flex-row flex-wrap flex-wrap-reverse align-items-center h-100 justify-content-center">
                    <div class="col-12 col-md-7 offset-md-5">
                        <h2 class="pucks_text">Začni hned a získej ty <b>nejlepší tipy</b> na <b>NHL</b>!
                        </h2>
                        <p class="pucks_text lead">
Přidej se k&nbsp;nám a začni taky sázením konečně opravdu vydělávat.</p>
                        <a href="{{ route('premium') }}" class="btn btn-lg text-uppercase w-50 rounded btn-light shadow-lg">ZÍSKAT PREMIUM TIPY</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
<div class="skew-header"></div>
    </div>

</header>
