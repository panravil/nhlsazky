@extends('clean.layouts.app')
@section('page')
    <section class="bg-gray-900">
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
@endsection
