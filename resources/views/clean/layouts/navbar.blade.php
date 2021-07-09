@inject('request', 'Illuminate\Http\Request')
<nav class="sticky-top">
    <div class="topbar bg-primary">
        <div class="container d-none d-md-flex">
            <ul class="nav" style="margin-left: 200px">
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="fab fa-instagram"></i> Instagram</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="fab fa-telegram-plane"></i> Telegram</a>
                </li>
            </ul>
            @auth
                <ul class="nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('premium') }}">
                            <i class="fas fa-hockey-puck login_premium_ico" aria-hidden="true"></i>
                            @foreach(\Illuminate\Support\Facades\Auth::user()->subscriptionsValid as $sub)
                                <span class="text-uppercase sidebar_aktivni">{{ $sub->package->title }}</span>
                                <span>({{ ($sub->to->format('d. m. Y')) }})</span>
                            @endforeach
                            @if(\Illuminate\Support\Facades\Auth::user()->subscriptionsValid->isEmpty() > 0)
                                PREMIUM: <span class="text-uppercase sidebar_neaktivni">NEAKTIVNÍ</span>
                            @endif
                        </a>
                    </li>

                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> Tezi</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin" target="_blank"><i
                                        class="fa fa-cogs"
                                        aria-hidden="true"></i> ADMIN</a>
                                <a class="dropdown-item" href="/muj-ucet"><i class="fas fa-user-edit"
                                                                             aria-hidden="true"></i> Můj účet</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/odhlasit"><i class="fas fa-sign-out"
                                                                             aria-hidden="true"></i>ODHLÁSIT</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/muj-ucet"><i class="fas fa-user-edit"
                                                                             aria-hidden="true"></i> Můj účet
                            </a>
                        </li>
                    @endif
                </ul>
            @else
                <ul class="nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLoginForm"><i
                                class="fas fa-fw fa-sign-in-alt"></i> Přihlásit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-fw fa-user-plus"></i>
                            Registrovat</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>

    <div class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid container-lg">
            <a class="navbar-brand" style="z-index: 100" href="/">
                <img src="/images/assets/logo.png" alt="Logo" style="  -webkit-filter: drop-shadow(5px 5px 5px #222 );
  filter: drop-shadow(0 1rem 3rem rgba(0,0,0,0.175));" class="img-responsive">
            </a>
            <button class="navbar-toggler collapsed ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto text-center">
                    <li class="nav-item {{ $request->segment(1) == '' ? 'active' : '' }}">
                        <a class="nav-link" href="/">DOMŮ <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ $request->segment(1) == 'o-mne' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about') }}">O MNĚ</a>
                    </li>
                    <li class="nav-item {{ $request->segment(1) == 'premium' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('premium') }}">PREMIUM TIPY</a>
                    </li>
                    <li class="nav-item {{ $request->segment(1) == 'statistiky' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('statsGlobal') }}">STATISTIKY</a>
                    </li>
                    <li class="nav-item {{ $request->segment(1) == 'soutez' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('soutez.index') }}">SOUTEŽ</a>
                    </li>
                    <li class="nav-item {{ $request->segment(1) == 'kontakt' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('contact') }}">KONTAKT</a>
                    </li>
                    @forelse(\App\Event::where('show_menu', 1)->get() as $ev)
                        <li class="nav-item nav-event p-2 p-md-0 d-flex align-items-center {{ $request->segment(1) == $ev->seo ? 'active' : '' }}">
                            <a class="btn btn-primary btn-lg btn-block text-uppercase"
                               href="{{ route('page', $ev->seo) }}">{{ $ev->title }}</a>
                        </li>
                    @empty
                        @guest()
                            <li class="nav-item nav-event p-2 p-md-0 d-flex align-items-center">
                                <a class="btn btn-primary btn-lg btn-block text-uppercase"
                                   href="{{ route('premium') }}">ZÍSKAT TIPY</a>
                            </li>
                        @endauth
                    @endforelse
                </ul>
                <div class="d-block d-md-none">
                    @auth
                        <div class="text-center">
                            <a class="nav-link" href="{{ route('premium') }}">
                                <i class="fas fa-hockey-puck login_premium_ico" aria-hidden="true"></i>
                                @foreach(\Illuminate\Support\Facades\Auth::user()->subscriptionsValid as $sub)
                                    <div>
                                        <span class="text-uppercase sidebar_aktivni">{{ $sub->package->title }}</span>
                                        <span>({{ ($sub->to->format('d. m. Y')) }})</span></div>
                                @endforeach
                                @if(\Illuminate\Support\Facades\Auth::user()->subscriptionsValid->isEmpty() > 0)
                                    PREMIUM: <span class="text-uppercase sidebar_neaktivni">NEAKTIVNÍ</span>
                                @endif
                            </a>
                        </div>
                        <ul class="navbar-nav ml-auto text-center">

                            <li class="nav-item {{ $request->segment(1) == 'muj-ucet' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('account') }}"><i class="fas fa-user"></i> Tezi</a>
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                                <li class="nav-item {{ $request->segment(1) == 'muj-ucet' ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                                            class="fa fa-cogs"
                                            aria-hidden="true"></i> ADMIN</a>
                                </li>
                            @endif
                        </ul>
                    @else
                        <ul class="navbar-nav ml-auto text-center d-md-none">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm">Přihlásit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registrovat</a>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @php
        $setting =\App\Setting::first();
    @endphp
    @auth()
        @if($setting->topbar_enable)
            @if($setting->live_enable)
                <div class="container">
                    <div class="row justify-content-center justify-content-md-end">
                        <div class="bg-gradient-premium position-absolute text-white shadow-lg px-2 col-12 col-md-7 col-lg-5 col-xl-4
                         d-flex justify-content-between align-items-center" style="border-radius: 0 0 1.5rem 1.5rem;">
                            <div class="px-2">
                                <p class="text-white m-0 lead">Právě pobíhá <b>LIVE SÁZENÍ</b><span class="d-none">, připojte se a vydělávejte s námi.</span>
                                </p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('live') }}"
                                   class="btn btn-white px-3 rounded text-uppercase">Připojit se
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="row justify-content-center justify-content-md-end">
                        <div class="bg-gradient-live position-absolute text-white shadow-lg px-2 col-12 col-md-7 col-lg-5 col-xl-4
                         d-flex justify-content-between align-items-center" style="border-radius: 0 0 1.5rem 1.5rem;">
                            <div class="px-2">
                                <p class="text-white m-0 lead">Právě pobíhá <b>LIVE SÁZENÍ</b><span class="d-none">, připojte se a vydělávejte s námi.</span>
                                </p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('live') }}"
                                   class="btn btn-white px-3 rounded text-uppercase">Připojit se
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endauth
</nav>
<div class="container" style="position: absolute; top: 125px">
    <div class="col-12">
        @include('admin.layouts.parts.alerts')</div>
</div>
