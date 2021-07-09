@extends('clean.layouts.app')
@section('title')
    Soutěž | NHL Sázení
@endsection
@section('page')
    <div class="container">
        <h1 class="page_tittle">Soutěž</h1>
        <div class="row">
            <div class="col-md-8 soutez_text">
                {!! \App\Section::findOrFail(7)->html_template !!}
                @guest
                    <div class="col-12">
                        @include('clean.layouts.parts.bannershort')
                    </div>
                @endguest
                <div class="col-12">
                    <div id="soutez_zapasy" class="rounded">
                        <h4 class="text-center">Plánované zápasy</h4>
                        <div class="list-group list_zapasy">
                            @forelse($matches as $match)
                                @include('front.competition.parts.matchTip', $match)
                            @empty
                                <div class="soutez_zapas list-group-item">
                                    <p class="m-0 text-center">
                                        V tomto kole již nejsou další zápasy
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                @auth
                    <div><h4 class="d-flex justify-content-between">Moje statistiky&nbsp;
                        <a
                            href="{{ route('soutez.show', \Illuminate\Support\Facades\Auth::user()->name) }}"
                            class="btn btn-light btn-sm text-uppercase rounded">zobrazit moje tipy</a>
                    </h4>
                    <div class="card">
                        <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Celkem bodů:</td>
                                <td class="text-center" width="30%">
                                    <strong>{{ \Illuminate\Support\Facades\Auth::user()->contestTipsWeek->sum('result')?? 0 }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>Celkový počet tipů:</td>
                                <td class="text-center"
                                    width="30%">{{ \Illuminate\Support\Facades\Auth::user()->contestTipsWeek->count()?? 0 }}</td>
                            </tr>
                            <tr>
                                <td>Počet úspěšných tipů:</td>
                                <td class="soutez_stats_vyhra text-center"
                                    width="30%">{{ \Illuminate\Support\Facades\Auth::user()->contestTipsWeek->where('result', '>', 0)->count() }}</td>
                            </tr>
                            <tr>
                                <td>Počet neúspěšných tipů:</td>
                                <td class="soutez_stats_prohra text-center"
                                    width="30%">{{ \Illuminate\Support\Facades\Auth::user()->contestTipsWeek->where('result', '<', 0)->count() }}</td>
                            </tr>
                            <tr>
                                <td>Počet nevyhodnocených tipů:</td>
                                <td class="soutez_stats_nevyhodnoceno text-center"
                                    width="30%">{{ \Illuminate\Support\Facades\Auth::user()->contestTipsWeek->where('result', '=', 0)->count() }}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                @endauth
                @guest
                    <div><h4>Moje statistiky&nbsp;
                    </h4>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Celkem bodů:</td>
                                    <td class="text-center" width="30%">
                                        <strong>0</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Celkový počet tipů:</td>
                                    <td class="text-center"
                                        width="30%">0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Počet úspěšných tipů:</td>
                                    <td class="soutez_stats_vyhra text-center"
                                        width="30%">0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Počet neúspěšných tipů:</td>
                                    <td class="soutez_stats_prohra text-center"
                                        width="30%">0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Počet nevyhodnocených tipů:</td>
                                    <td class="soutez_stats_nevyhodnoceno text-center"
                                        width="30%">0
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                @endguest
                <div class="my-3"><h4>Průběžné umístění</h4>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table_soutez">
                                <thead class="bg-dark">
                                <tr>
                                    <th><span class="d-none d-lg-inline">Pozice / </span>Uživatel</th>
                                    <th class="text-center" width="13%" title="počet tipů">T</th>
                                    <th class="text-center" width="13%" title="počet uhodnutých tipů">V</th>
                                    <th class="text-center" width="13%" title="počet neuhodnutých tipů">P</th>
                                    <th class="text-center" width="13%">Body</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->index +1 }}. <a href="/soutez/{{ $user->name }}"
                                                                      class="soutez_stats_odkaz">{{ $user->name }}</a>
                                        </td>
                                        <td class="text-center">{{ $user->total }}</td>
                                        <td class="soutez_stats_vyhra text-center">{{ $user->good }}</td>
                                        <td class="soutez_stats_prohra text-center">{{ $user->bad }}</td>
                                        <td class="text-center">{{ $user->body }}</td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3"><h4>Poslední výherci&nbsp;</h4>
                        <div class="card">
                            <div class="card-body"
                            <table class="table table-striped">

                                <tbody>
                                @foreach(\App\Contest::orderBy('id', 'desc')->take(5)->get() as $vyherce)
                                    <tr>
                                        <td class="text-center">Týden/Rok: {{ $vyherce->tydenrok }}</td>
                                        <td class="text-center" width="50%"><strong>{{ $vyherce->user->name }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="/js/soutez.js?v1"></script>
@endsection
