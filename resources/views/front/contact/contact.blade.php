@extends('clean.layouts.app')
@section('page')
    <section>
        <div class="container">
            <!-- Heading Row -->
            <div class="row d-flex justify-content-center my-5">

                <div class="col-12 col-md-4 col-lg-5 accordion" id="accordionFAQ">
                    <h2 class="text-center">FAQ</h2>
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
                                    Měsíčne si sázením NHL zápasů vydělám v průměru 55 000 Kč (každý měsíc je samozřejmě
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
                                <p class="font-weight-light m-0">Ano můžeš, veškerou analytickou práci dělám já. Ty ode
                                    mě pouze
                                    obdržíš notifikaci s dostatečným šasovým předstihem, který zápas, za kolik a jak máš
                                    vsadit. Mezi mé
                                    klienty patří studenti, podnikatelé i ženy na mateřské.</p>
                            </div>
                        </div>
                    </div><!-- End -->

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
                                <p class="font-weight-light m-0">Díky platební brány budeš mít členství aktivn uží do
                                    pár minut od zaplacení.</p>
                            </div>
                        </div>
                    </div>
                </div>
                    <a href="{{ route('faq') }}" class="btn btn-white btn-block mt-3">Další často kladené otázky</a>
                </div>
                <div class="col-12 col-md-8 col-lg-7">
                    <h2 class="text-center">KONTAKT</h2>
                    <div class="card mb-2 border-0 rounded shadow-lg">
                        <div class="card-body p-4 p-md-4    ">
                            {!! Form::open(['url' => route('sendContact'), 'method' => 'POST']) !!}
                            {{ csrf_field() }}
                            <input type="text" id="website" class="d-none" name="website"/>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Jméno:</label>
                                        @auth
                                            <input class="form-control" readonly id="name" name="name" type="text"
                                                   aria-label="jmeno"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                                   required
                                                   data-validation-required-message="Prosím zadejte vaše jméno.">
                                        @else
                                            <input class="form-control" id="name" name="name" type="text"
                                                   aria-label="jmeno"
                                                   placeholder="*" required
                                                   data-validation-required-message="Prosím zadejte vaše jméno.">
                                        @endauth
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="email">E-mail:</label>
                                        @auth
                                            <input class="form-control" readonly id="email" name="email" type="email"
                                                   aria-label="email"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->email }}"
                                                   required
                                                   data-validation-required-message="Zadejte vaši e-mail adresu ať vás můžeme kontaktovat zpět.">
                                        @else
                                            <input class="form-control" id="email" name="email" type="email"
                                                   aria-label="email"
                                                   placeholder="*" required
                                                   data-validation-required-message="Zadejte vaši e-mail adresu ať vás můžeme kontaktovat zpět.">
                                        @endauth
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="text" class="sr-only">Zpráva:</label>
                                <textarea class="form-control" aria-required="true" rows="5" id="text" name="text"
                                          aria-label="text" placeholder="Co pro vás můžeme udělat ?" required
                                          data-validation-required-message="Co nám chcete sdělit ?"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-row">
                                <div id="success"></div>
                            </div>
                            <div class="d-flex justify-content-between align-content-center">
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox mb-0">
                                        <input type="checkbox" class="custom-control-input" name="terms" id="terms"
                                               required="">
                                        <label class="custom-control-label mont text-center" for="terms">Souhlas se
                                            <a href="{{ route('terms')  }}" target="_blank"> zpracováním osobních údajů.</a></label>
                                    </div>
                                </div>
                                <button id="sendMessageButton" class="btn btn-primary text-center px-4" type="submit"><i
                                        class="fas fa-paper-plane"></i> ODESLAT
                                </button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div id="status_errors"
                         class="alert alert-danger animated--grow-in alert-dismissible show d-none fade w-100"
                         role="alert">
                        <ul class="mb-0"></ul>
                    </div>
                    <div id="status_sent"
                         class="alert alert-success animated--grow-in alert-dismissible d-none fade show w-100"
                         role="alert">
                        <strong>The message was sent</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
