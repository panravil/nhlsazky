@extends('front.layout.app')
@section('title')
Premium tipy | NHL Sázení
@endsection
@section('page')
    <div class="container">
        <div class="row">
                <div class="col-md-6 no_padding"><h1 class="page_tittle">Můj účet</h1>
                    <div class="px-3 pb-3">
                        <div class="">
                            <table class="table table-striped table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 35%">MOJE ID:</th>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->id }}</td>
                                </tr>
                                <tr>
                                    <th>Uživatelské jméno:</th>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                                </tr>

                                </tbody>
                            </table>
                            <div class="p-3">
                                                   {!! Form::open(['url' => route('accountEditEmail') , 'method' => 'PATCH']) !!}
                                @csrf
                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::email('email', \Illuminate\Support\Facades\Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Upravit',  ['class' => 'btn btn-primary']) }}
                    <a href="{{ route('account') }}" class="float-right btn btn-secondary">Zpět</a>
                </div>
                {!! Form::close() !!}</div>
                        </div>
                        <div class="btn-group-sm">
                            @if(\Illuminate\Support\Facades\Auth::user()->notifications)
                                <form action="{{ route('updateNotification') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="notifications" value="0">
                                    <button class="btn btn-sm btn-block btn-dark" type="submit"><i
                                            class="fa fa-bell fa-fw"></i> Vypnout notifikace
                                    </button>
                                </form>
                            @else
                                <form action="{{  route('updateNotification') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="notifications" value="1">
                                    <button class="btn btn-sm btn-block btn-primary" type="submit"><i
                                            class="fa fa-bell-slash fa-fw"></i> Zapnout notifikace
                                    </button>
                                </form>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->newsletter)
                                <form action="{{ route('updateNewsletter') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="newsletter" value="0">
                                    <button class="btn btn-sm btn-block btn-dark" type="submit"><i
                                            class="fa fa-bell fa-fw"></i> Vypnout newsletter
                                    </button>
                                </form>
                            @else

                                <form action="{{ route('updateNewsletter') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="newsletter" value="1">
                                    <button class="btn btn-sm btn-block btn-primary" type="submit"><i
                                            class="fa fa-bell-slash fa-fw"></i> Zapnout newsletter
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 no_padding">
                    <h1 class="page_tittle">Prémium členství</h1>
                    <div>
                        @foreach(\Illuminate\Support\Facades\Auth::user()->subscriptionsValid as $sub)
                        @if(\Carbon\Carbon::today()->diffInDays($sub->to) < 3)
                            <div class="alert alert-danger" role="alert">
                                <h5 class="alert-heading p-1"><b>{{ $sub->package->title }}</b>: členství brzo vypší.
                                </h5>
                                @if(\Carbon\Carbon::today()->diffInDays($sub->to) == 0)
                                    <p class="pb-0 mb-0">Vaše členství končí: <b>DNES</b> <span
                                            class="d-none d-md-inline-block">({{ $sub->to->format('d. m. Y') }})</span>
                                    </p>

                                @else
                                    <p class="pb-0 mb-0">Počet dnů do konce členství:
                                        <b>{{ \Carbon\Carbon::today()->diffInDays($sub->to) }}</b> <span
                                            class="d-none d-md-inline-block">({{ $sub->to->format('d. m. Y') }})</span>
                                    </p>
                                @endif

                                @if($sub->package->show == 1)
                                <a href="#buy-1" data-toggle="modal" data-target="#buy-{{ $sub->package->id }}"
                                   class="btn btn-block btn-primary shadow" style="color: white;">PRODLOUŽIT ČLENSTVÍ</a>
                                    @endif
                            </div>
                        @endif
                    @endforeach
                    </div>

            <div class="row" style="padding-left: 10px; padding-right: 10px">
                        <div class="col-6" style="padding: 5px;">
                            <a href="#buy-1" data-toggle="modal" data-target="#buy-1">
                                <div class="premium_box">
                                    <div class="coiny_nazev bg-premium-gradient text-center">PREMIUM TIPY</div>
                                    <div
                                        class=" text-center premium_box_platnost">{{ \Illuminate\Support\Facades\Auth::user()->findSub(1) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(1)->to->format('d.m. Y') : 'KOUPIT' }}</div>
                                </div>
                            </a></div>
                        <div class="col-6" style="padding: 5px;">
                            <a href="#buy-2" data-toggle="modal" data-target="#buy-2">
                                <div class="premium_box bg-mega-gradient">
                                    <div class="coiny_nazev text-center">MEGA KURZY</div>
                                    <div
                                        class=" text-center premium_box_platnost">{{ \Illuminate\Support\Facades\Auth::user()->findSub(2) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(2)->to->format('d.m. Y') : 'KOUPIT' }}</div>

                                </div>
                            </a></div>
                        <div class="col-6" style="padding: 5px;">
                            <a href="#buy-3" data-toggle="modal" data-target="#buy-3">
                                <div class="premium_box bg-live-gradient">
                                    <div class="coiny_nazev text-center">LIVE SAZKY</div>
                                    <div
                                        class=" text-center premium_box_platnost">{{ \Illuminate\Support\Facades\Auth::user()->findSub(3) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(3)->to->format('d.m. Y') : 'KOUPIT' }}</div>

                                </div>
                            </a></div>
                        <div class="col-6" style="padding: 5px;">
                            <a href="#buy-4" data-toggle="modal" data-target="#buy-4">
                                <div class="premium_box bg-allin-gradient">
                                    <div class="coiny_nazev text-center">ALL-IN</div>
                                    <div
                                        class=" text-center premium_box_platnost">{{ \Illuminate\Support\Facades\Auth::user()->findSub(4) ? 'DO: '. \Illuminate\Support\Facades\Auth::user()->findSub(4)->to->format('d.m. Y') : 'KOUPIT' }}</div>

                                </div>
                            </a></div>
                        <div class="col-12 text-center" style="padding-top: 20px"><img class="img-responsive"
                                                                                          src="/images/barion-card-payment-mark-2017-500px.png">
                        </div>
                    </div>
                    @include('front.layout.modals')
                </div>
            </div>
    </div>
@endsection
