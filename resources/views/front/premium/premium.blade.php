@extends('clean.layouts.app')
@section('title')
    Premium tipy | NHL Sázení
@endsection
@section('page')
    <div class="container">
        <div class="row">
            <div class="col-md-12 content"  >
                <h1 class="page_tittle">Premium členství</h1>
                <div class="row">
                    <div class="col-12 col-sm-9 d-flex align-items-center flex-wrap">
                        <div class="col-6 col-sm-3" style="padding: 5px;">
                            <a href="#buy-1" data-toggle="modal" data-target="#buy-1">
                                <div class="premium_box bg-premium-gradient">
                                    <div class="coiny_nazev text-center">PREMIUM TIPY</div>
                                    @auth
                                        <div
                                            class="premium_box_platnost text-center">{{ \Illuminate\Support\Facades\Auth::user()->findSub(1) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(1)->to->format('d.m. Y') : 'KOUPIT' }}</div>
                                    @else
                                        <div
                                            class="premium_box_platnost text-center">KOUPIT
                                        </div>
                                    @endauth
                                </div>
                            </a></div>
                        <div class="col-6 col-sm-3" style="padding: 5px;">
                            <a href="#buy-2" data-toggle="modal" data-target="#buy-2">
                                <div class="premium_box bg-mega-gradient">
                                    <div class="coiny_nazev text-center">MEGA KURZY</div>
                                    @auth
                                        <div
                                            class="premium_box_platnost text-center">{{ \Illuminate\Support\Facades\Auth::user()->findSub(2) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(2)->to->format('d.m. Y') : 'KOUPIT' }}</div>
                                    @else
                                        <div
                                            class="premium_box_platnost text-center">KOUPIT
                                        </div>
                                    @endauth
                                </div>
                            </a></div>
                        <div class="col-6 col-sm-3" style="padding: 5px;">
                            <a href="#buy-3" data-toggle="modal" data-target="#buy-3">
                                <div class="premium_box bg-live-gradient">
                                    <div class="coiny_nazev text-center">LIVE SAZKY</div>
                                    @auth
                                        <div
                                            class="premium_box_platnost text-center">{{ \Illuminate\Support\Facades\Auth::user()->findSub(3) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(3)->to->format('d.m. Y') : 'KOUPIT' }}</div>
                                    @else
                                        <div
                                            class="premium_box_platnost text-center">KOUPIT
                                        </div>
                                    @endauth
                                </div>
                            </a></div>
                        <div class="col-6 col-sm-3" style="padding: 5px;">
                            <a href="#buy-4" data-toggle="modal" data-target="#buy-4">
                                <div class="premium_box bg-allin-gradient">
                                    <div class="coiny_nazev text-center">ALL-IN</div>
                                    @auth
                                        <div
                                            class="premium_box_platnost text-center">{{ \Illuminate\Support\Facades\Auth::user()->findSub(4) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(4)->to->format('d.m. Y') : 'KOUPIT' }}</div>
                                    @else
                                        <div
                                            class="premium_box_platnost text-center">KOUPIT
                                        </div>
                                    @endauth
                                </div>
                            </a></div>
                    </div>
                    <div class="col-12 col-sm-3 py-2">
                        <a href="{{ route('dictionary') }}" class="btn btn-block btn-primary"><span
                                class="text-uppercase font">slovník pojmů</span></a>
                        <a href="{{ route('faq') }}" class="btn btn-block btn-primary">FAQ</a>
                    </div>
                </div>
                @foreach($tickets as $ticket)
                    @include('front.premium.parts.ticket', $ticket)
                @endforeach
            </div>

        </div>
    </div>
    @include('front.layout.modals')
@endsection
