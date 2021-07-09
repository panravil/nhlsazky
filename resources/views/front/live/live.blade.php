@extends('clean.layouts.app')
@section('title')
    Live Sázky | NHL Sázení
@endsection
@section('styles')
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }


        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel .slidedown .glyphicon, .chat .glyphicon {
            margin-right: 5px;
        }

        .panel-body {
            overflow-y: scroll;
            padding: 1rem;
            height: 450px;
        }

    </style>
@endsection
@section('page')
    <div class="container">
        <div class="row">
            <div class="col-12 no_padding">
                <div class="container zapasy-live">
                    <h4 class="text-center">Live Sázky</h4>

                    <div id="zapasy" aria-expanded="false">
                        @foreach(\App\Match::where([['show', '>', 0], ['start', '>', \Carbon\Carbon::now()->addHours(-3)]])->orderBy('start', 'asc')->limit(4)->get() as $match)
                            <div class="col-6 col-sm-4 col-md-3 zapasek">
                                <div class="hlavni_zapasy bg-zapas-{{ $match->timelabel }}">
                                    <div class="row zapas-info">
                                    <span class="badge hlavni_zapas_{{ $match->timelabel }}"
                                          style="float: left;">{{ $match->timelabel }}</span>
                                        <span
                                            class="hlavni_zapas_stred_datum">{{ $match->start->format('d.m. H:i') }}</span>
                                    </div>
                                    <div class="row zapas-teams">
                                        <div class="col-6 col-md-4 col-sm-4 text-center">
                                            <img src="/images/tymy_loga/{{ $match->host->icon }}?re"
                                                 alt="{{ $match->host->name }}"
                                                 title="{{ $match->host->name }}" class="img-team"><span
                                                class="d-block d-sm-none h4">{{ $match->score_host }}</span>
                                        </div>
                                        <div class="d-none d-sm-block col-md-4 col-sm-4 text-center">
                                            <div class="hlavni_zapas_stred_vs">{{ $match->score_host }}
                                                : {{ $match->score_guest }}</div>
                                        </div>
                                        <div class="col-6 col-md-4 col-sm-4 text-center">
                                            <img src="/images/tymy_loga/{{ $match->guest->icon }}?re"
                                                 alt="{{ $match->guest->name }}"
                                                 title="{{ $match->guest->name }}" class="img-team"><span
                                                class="d-block d-sm-none h4">{{ $match->score_guest }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12">
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        @if($nastaveni->live_enable == 0)
                            <a href="{{ route('admin.enableLive') }}" type="button"
                               class="btn btn-sm btn-success text-white">Zapnout LIVE</a>
                        @else
                            <a href="#" data-toggle="modal" data-target="#topbarModal" class="btn btn-sm btn-warning">Nastavit
                                upozornění</a>
                            <a href="{{ route('admin.disableLive') }}" type="button" class="btn btn-sm btn-danger">Vypnout
                                LIVE</a>
                        @endif
                    </div>
                    @if($nastaveni->live_enable)

                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-7">
                <h1 class="subtitle" style="margin-bottom: 0">TIKETY</h1>
                @if($nastaveni->live_enable)
                    @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <a href="#" data-toggle="modal" data-target="#ticketModal" class="btn btn-sm btn-success">PŘIDAT TIKET</a>
                </div>

                        @endif

                                                  <ul id="live-tikety listgroup" style="padding: 0;     line-height: 1.8;
    font-size: 13px;">
                                @foreach(\App\Ticket::where('package_id', '=', 3)->orderBy('created_at', 'desc')->limit(5)->get() as $ticket)
                                    @include('front.live.parts.ticket', $ticket)
                                @endforeach
                                </ul>
                    @else
                              <div class="alert alert-info">
                                <div class="alert-info"><b>Aktuálně neprobíhá live sázení</b></div>
                            </div>
                @endif
            </div>
            <div class="col-12 col-md-5">
                <div class="text-center">
                    <h1 class="subtitle" style="margin-bottom: 0">CHAT</h1>
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        @if($nastaveni->live_chat == 0)
                            <a href="{{ route('admin.enableChat') }}" type="button" class="btn btn-sm btn-success">Zapnout
                                chat</a>
                        @else
                            <a href="{{ route('admin.disableChat') }}" type="button" class="btn btn-sm btn-warning">Smazat
                                chat</a>
                            <a href="{{ route('admin.disableChat') }}" type="button" class="btn btn-sm btn-danger">Vypnout
                                chat</a>
                        @endif
                    </div>

                </div>
                <div class="shadow">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            @if($nastaveni->live_chat == 1)
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">SlonikPonik</span>
                                        <span class="direct-chat-timestamp pull-right">22 1 1:08 pm</span>
                                    </div>
                                    <div class="direct-chat-text">
                                        Text zprávy
                                    </div>
                                </div>
                                <div class="direct-chat-msg direct-chat-primary">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">Tezi</span>
                                        <span class="direct-chat-timestamp pull-right">22. 1. 1:12</span>
                                    </div>
                                    <div class="direct-chat-text">
                                        Admin 😁
                                    </div>
                                </div>
                            <div style="padding: 0; line-height: 1.5; font-size: 12px;">
                                @foreach(\App\Ticket::where('package_id', '=', 3)->orderBy('created_at', 'desc')->limit(1)->get() as $ticket)
                                    @include('front.live.parts.ticket', $ticket)
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @if($nastaveni->live_chat == 0)
                            <div class="alert alert-info">
                                <div class="alert-heading"><b>Chat je momentálně vypnut</b></div>
                            </div>
                        @endif
                        <div class="panel-footer p-1">
                            <form method="POST" id="form-chat" name="add">
                                <div id="contact_results"></div>
                                <div class="form-group mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm" name="zprava" id="input"
                                               placeholder="Vaše zpráva (max 500 znaků)" value="" maxlength="500"
                                               autocomplete="off" required {{ !$nastaveni->live_chat ? 'disabled': '' }}>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-paper-plane"  {{ !$nastaveni->live_chat ? 'disabled': '' }}></i>
                            </button>
                        </span>
                                    </div>

                                    <div class="d-none d-sm-block">
                                        <img onclick="Smile(':1: ')" src="/images/smileys/1.gif">
                                        <img onclick="Smile(':3: ')" src="/images/smileys/3.gif">
                                        <img onclick="Smile(':4: ')" src="/images/smileys/4.gif">
                                        <img onclick="Smile(':5: ')" src="/images/smileys/5.gif">
                                        <img onclick="Smile(':6: ')" src="/images/smileys/6.gif">
                                        <img onclick="Smile(':7: ')" src="/images/smileys/7.gif">
                                        <img onclick="Smile(':8: ')" src="/images/smileys/8.gif">
                                        <img onclick="Smile(':9: ')" src="/images/smileys/9.gif">
                                        <img onclick="Smile(':10: ')" src="/images/smileys/10.gif">
                                        <img onclick="Smile(':11: ')" src="/images/smileys/11.gif">
                                        <img onclick="Smile(':12: ')" src="/images/smileys/12.gif">
                                        <img onclick="Smile(':13: ')" src="/images/smileys/13.gif">
                                        <img onclick="Smile(':14: ')" src="/images/smileys/14.gif">
                                        <img onclick="Smile(':15: ')" src="/images/smileys/15.gif">
                                        <img onclick="Smile(':16: ')" src="/images/smileys/16.gif">
                                        <img onclick="Smile(':17: ')" src="/images/smileys/17.gif">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.layout.modals')
    @include('front.live.parts.modals')
@endsection
