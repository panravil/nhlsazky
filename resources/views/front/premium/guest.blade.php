@extends('clean.layouts.app')
@section('title')
    Premium tipy | NHL Sázení
@endsection
@section('page')
    <div class="container my-3 my-md-4">
        <div class="row">
            <br/>
            <div class="col text-center">
                <h2>Premium členství</h2>
                <p>Vyber si balíček přesně podle tvých potřeb.</p>
            </div>

        </div>
        <div class="row">
            <div class="col-md-3 py-2 p-md-2">
                <div class="card package_card bg-premium-gradient h-100">
                    <div class="card-body">
                        <h4 class="card-title text-center">PREMIUM TIPY
                        </h4>
                        <ul>
                            <li>Denně <b>1-5 tipů</b></li>
                            <li>Kurzy <b>1.50 - 2.99</b></li>
                            <li>Doporučené vklady</li>
                            <li>E-mail notifikace</li>
                        </ul>
                    </div>
                    <div class="card-footer px-2 bg-premium-gradient">
                        <div class="btn-group d-flex" role="group" aria-label="...">
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['premium-tipy-10', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>10&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(1)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(1)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a>
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['premium-tipy-30', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>30&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(2)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(2)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-2 p-md-2">
                <div class="card package_card bg-mega-gradient h-100">
                    <div class="card-body">
                        <h4 class="card-title text-center">MEGA KURZY
                        </h4>
                        <ul>
                            <li>Denně <b>1-3 tipů</b></li>
                            <li>Kurzy <b>3.00 - 7.00</b></li>
                            <li>Doporučené vklady</li>
                            <li>E-mail notifikace</li>
                        </ul>
                    </div>
                    <div class="card-footer px-2 bg-mega-gradient">
                        <div class="btn-group d-flex" role="group" aria-label="...">
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['mega-kurzy-10', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>10&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(3)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(3)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a>
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['mega-kurzy-30', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>30&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(4)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(4)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-2 p-md-2">
                <div class="card package_card bg-live-gradient h-100">
                    <div class="card-body">
                        <h4 class="card-title text-center">LIVE SAZKY
                        </h4>
                        <ul>
                            <li>Vždy <b>3-6 tipů</b></li>
                            <li>alespoň <b>3x týdně</b></li>
                            <li>Doporučené vklady</li>
                            <li>Webové notifikace</li>
                        </ul>
                    </div>
                    <div class="card-footer px-2 bg-live-gradient">
                        <div class="btn-group d-flex" role="group" aria-label="...">
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['live-sazky-10', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>10&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(5)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(5)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a>
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['live-sazky-30', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>30&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(6)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(6)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 py-2 p-md-2">
                <div class="card package_card bg-allin-gradient h-100">
                    <div class="card-body">

                        <h4 class="card-title text-center">ALL-IN
                        </h4>
                        <ul class="my-0 py-0 font-weight-bold">
                            <li>Premium tipy</li>
                            <li>Mega kurzy</li>
                            <li>Live sázky</li>
                            <li>Prostě všechny tipy</li>
                        </ul>
                    </div>
                    <div class="card-footer px-2 bg-allin-gradient">
                        <div class="btn-group d-flex" role="group" aria-label="...">
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['all-in-1', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>1&nbsp;DEN</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(7)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(7)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a>
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['all-in-10', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>10&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(8)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(8)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a>
                            <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                               href="{{ route('platba', ['all-in-30', 'czk']) }}">
                                <div class="modal-tlacitko">
                                    <div>30&nbsp;DNÍ</div>

                                    <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                    <div style="text-transform: none">{{ \App\Tariff::findOrFail(9)->priceCZK }}&nbsp;Kč
                                        | {{ \App\Tariff::findOrFail(9)->priceEUR }}&nbsp;€
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-dark">
        <div class="container">
            <div class="row mb-3">
                <br/>
                <div class="col text-center">
                    <h2>Zjistětě kolik můžete vydělat!</h2>
                    <p>Spočítejte si možné výhry a návratnost své investice!</p>
                </div>

            </div>
        </div>
        @include('clean.home.parts.calculator')
    </section>
    <section class=" mb-0">
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
                            <a href="#" class="btn btn-link p-0 p-md-2"><i class="fab fa-instagram fa-fw fa-5x"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-link p-0 p-md-2"><i
                                    class="fab fa-telegram-plane fa-fw fa-5x"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-link p-0 p-md-2"><i class="fas fa-envelope fa-fw fa-5x"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-8 col-lg-9 col-xl-7">
                    <!-- Accordion -->
                    <div id="accordionExample" class="accordion shadow">


                        <div class="card bg-dark shadow-lg">
                            <div id="headingOne" class="card-header shadow-sm border-0">
                                <h5 class="mb-0">
                                    <a href="#" type="button" data-toggle="collapse" data-target="#collapseOne"
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
                                        Měsíčne si sázením NHL zápasů vydělám v průměru 55 000 Kč (každý měsíc je
                                        samozřejmě
                                        jiný).</p>
                                </div>
                            </div>
                        </div><!-- End -->

                        <!-- Accordion item 2 -->
                        <div class="card bg-dark">
                            <div id="headingTwo" class="card-header shadow-sm border-0">
                                <h5 class="mb-0">
                                    <a href="#" type="button" data-toggle="collapse" data-target="#collapseTwo"
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
                                    <p class="font-weight-light m-0">Ano můžeš, veškerou analytickou práci dělám já. Ty
                                        ode
                                        mě pouze
                                        obdržíš notifikaci s dostatečným šasovým předstihem, který zápas, za kolik a jak
                                        máš
                                        vsadit. Mezi mé
                                        klienty patří studenti, podnikatelé i ženy na mateřské.</p>
                                </div>
                            </div>
                        </div><!-- End -->

                        <!-- Accordion item 3 -->
                        <div class="card">
                            <div id="headingThree" class="card-header shadow-sm border-0">
                                <h5 class="mb-0">
                                    <a href="#" type="button" data-toggle="collapse" data-target="#collapseThree"
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
                                    <a href="#" type="button" data-toggle="collapse" data-target="#collapseFour"
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
                                    <p class="font-weight-light m-0">Premium členství zahrnuje předzápasové (premium)
                                        tipy,
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
                                    <a href="#" type="button" data-toggle="collapse" data-target="#collapseFive"
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
                                    <p class="font-weight-light m-0">Díky platební brány budeš mít členství aktivn uží
                                        do
                                        pár minut od zaplacení.</p>
                                </div>
                            </div>
                        </div>

                    </div><!-- End -->
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid bg-white">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="/images/barion-card-payment-mark-2017-500px.png">
            </div>
        </div>
    </div>
@endsection
