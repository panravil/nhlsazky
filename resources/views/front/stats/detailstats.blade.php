@extends('clean.layouts.app')

@php
    use App\Ticket;
    if ($package->id != 4) {
    $ticketsall = Ticket::whereBetween('created_at', [$stat->from, $stat->to])->where('package_id', $package->id)->where('show', 1)->where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
    } else {
    $ticketsall = Ticket::whereBetween('created_at', [$stat->from, $stat->to])->where('status', '!=', 0)->where('show', 1)->orderBy('created_at', 'desc')->get();
    }
    $total = $ticketsall->where('status', '!=', 0)->count();
    $win = $ticketsall->where('status', 1)->count();
    $lose = $ticketsall->where('status', 2)->count();
    $return = $ticketsall->where('status', 3)->count();
    if ($total > 0) {
        $acc = round(100*(($ticketsall->where('status', 1)->count()) / $ticketsall->where('status', '!=', 0)->where('status', '!=', 3)->count()),2);
    } else {
        $acc = 100;
    }
    $avgodd = round($ticketsall->avg('odds'), 2);
    $avgcost =  round($ticketsall->avg('cost'), 2);
    if ($lose > 0) {
        $roi = round(100*($ticketsall->where('status', 1)->sum('profit') / $ticketsall->where('status', 2)->sum('cost')),2);
    } else {
        $roi = 100;
    }
    $profitj = round($ticketsall->where('status', '=', 1)->sum('profit') - $ticketsall->where('status', '=', 2)->sum('cost'), 2);
    $profit = number_format(($ticketsall->where('status', '=', 1)->sum('profit') - $ticketsall->where('status', '=', 2)->sum('cost')) * 500,0, ' ', ' ');

@endphp

@section('page')
    <div class="container my-3 my-md-4">
        <div class="row">
            <br/>
            <div class="col text-center">
                <h1 class="page_tittle">Statistiky <a href="{{ route('statsPackage', $typ) }}"><span
                            class="text-uppercase">{{$typ}}</span></a> sezóny
                    <span style="color:#ffffff; font-weight: bold" class="dropdown">
                            <a class="" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $sezona }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach($stats_seasons as $stat)
                                    <a href="{{ route('statsDetail', [$typ, $stat->season, 'celkove-obdobi']) }}"
                                       class="dropdown-item {{ $sezona == $stat->season ? 'active disabled': ''}}">
                                        sezóna {{  str_replace("-","/", $stat->season)}}</a>
                                @endforeach
                            </div>
                        </span> za
                    <span style="color:#ffffff; font-weight: bold" class="dropdown">
                            <a class="" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $obdobi }}</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach($stats as $stat)
                                    <a href="{{ route('statsDetail', [$typ, $stat->season, $stat->seo]) }}"
                                       class="dropdown-item {{ $obdobi == $stat->seo ? 'active disabled': ''}}">
                                        {{ $stat->title }}</a>
                                @endforeach
                            </div>
                        </span>
                </h1>
            </div>
        </div>
        <div class="row text-center pt-3" id="counters">
            <div class="col-6 col-md-3 col-lg">
                <div class="counter">
                    <i class="fas fa-clipboard-list fa-2x"></i>
                    <h2 id="tip_count" class="timer count-title count_number" data-to="100" data-speed="1500">
                        <span>{{$ticketsall->where('show', 1)->count() }}</span>
                    </h2>
                    <p class="count-text ">Tipů</p>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg">
                <div class="counter">
                    <i class="fas fa-clipboard-check fa-2x"></i>
                    <h2 class="timer count-title count_number" data-to="157" data-speed="1500">
                        <span>{{ $ticketsall->where('status', 1)->count() }}</span></h2>
                    <p class="count-text ">Úspěšných tipů</p>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg">
                <div class="counter">
                    <i class="fas fa-thumbs-up fa-2x"></i>
                    <h2 id="avg_odd" class="timer count-title count_number_decimal" data-to="1700" data-speed="1500">
                        <span>{{ round($ticketsall->avg('odds'), 2) }}</span>
                    </h2>
                    <p class="count-text ">Průměrný kurz</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg">
                <div class="counter">
                    <i class="fas fa-piggy-bank fa-2x"></i>
                    <h2 class="timer count-title count_number" data-to="11900" data-speed="1500">
                        <span>{{ ($ticketsall->where('status', '=', 1)->sum('profit') - $ticketsall->where('status', '=', 2)->sum('cost')) * 500 }}</span>
                        Kč</h2>
                    <p class="count-text ">Čitý získ</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content" style="padding:0 10px 30px 10px;">
                <div class="card">
                    <ul class="nav nav-pills d-flex justify--between p-3 mb-0">
                        <li class="dropdown nav-item col-6 col-md-3 col-lg-2 px-1 pb-2">
                            <a class="nav-link btn btn-primary dropdown-toggle w-100" href="#" role="button"
                               id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $sezona }}
                            </a>
                            <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                @foreach($stats_seasons as $stat)
                                    <a href="{{ route('statsDetail', [$typ, $stat->season, 'celkove-obdobi']) }}"
                                       class="dropdown-item {{ $sezona == $stat->season ? 'active disabled': ''}}">
                                        sezóna {{  str_replace("-","/", $stat->season)}}</a>
                                @endforeach
                            </div>
                        </li>
                        @foreach($stats as $stat)
                            <li class="nav-item pb-2 px-1 {{ $loop->last ? 'col-12 col-md-6 col-lg-4' : 'col-6 col-md-3 col-lg-2'}}">
                                <a class="nav-link {{ $obdobi == $stat->seo ? 'btn btn-primary': 'btn btn-secondary'}}"
                                   href="{{ route('statsDetail', [$typ, $stat->season, $stat->seo]) }}">{{ $stat->title }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-striped ">
                                    <tbody>
                                    <tr>
                                        <td style="width: 60%">Počet tipů:</td>
                                        <td style="width: 40%"><b>{{ $total }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Výherních:</td>
                                        <td><b>{{ $win  }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Proherních:</td>
                                        <td><b>{{ $lose  }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Vrácen vklad:</td>
                                        <td><b>{{ $return  }} </b></td>
                                    </tr>

                                    <tr>
                                        <td>Úspěšnost v %:</td>
                                        <td>
                                            <b>{{ $acc }}
                                                %</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-striped ">
                                    <tbody>
                                    <tr>
                                        <td style="width: 60%">Průměrný kurz:</td>
                                        <td style="width: 40%"><b>{{ $avgodd  }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Průměrný vklad:</td>
                                        <td><b>{{ $avgcost  }} jednotek</b></td>
                                    </tr>
                                    <tr>
                                        <td>ROI:</td>
                                        <td>
                                            <b>{{ $roi }}
                                                %</b></td>
                                    </tr>
                                    <tr>
                                        <td>Profit v jednotkách:</td>
                                        <td><b>{{ $profitj }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Čistý zisk v Kč:</td>
                                        <td><b>{{ $profit }} Kč*</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div id="chart_div2">
                                </div>
                                <div class="text-right">* 1 jednotka = 500 Kč</div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('clean.layouts.parts.bannerlong')
                @if(!$tickets->isEmpty())
                    <hr>
                    <h3 class="text-center">Seznam tiketů</h3>
                    <div class="">
                        <table class="table table_tikety rounded">
                            <thead class="theme--dark">
                            <tr>
                                <td class="d-none d-sm-table-cell" width="12%">Datum zápasu</td>
                                <td>Zápas</td>
                                <td class="d-none d-sm-table-cell">Tip</td>
                                <td class="d-none d-sm-table-cell" width="10%">Kurz</td>
                                <td class="d-none d-sm-table-cell" width="10%">Vklad</td>
                                <td width="10%">Typ</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                @include('front.stats.detail.ticket', $ticket)
                            @endforeach
                        </table>
                    </div>
                @else

                    <h2>V tomto období nebyl přidán žádný tip</h2>
                @endif
                <div class="row pt-3 pt-md-2">
                    <div class="col-md-12">
                        {{ $tickets->links()}}
                    </div>
                </div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {packages: ["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Výhry', {{$ticketsall->where('status', 1)->count()}}],
                            ['Prohry', {{ $ticketsall->where('status', 2)->count() }}]
                        ]);
                        var options = {
                            title: "Statistiky sezóny {{ $sezona }} za {{ $stat->title }}",
                            pieHole: 0.4,
                            height: "100%",
                            width: "100%",
                            'backgroundColor': 'none',
                            'backgroundColor.stroke': 'red',
                            'legend': {position: 'labeled', textStyle: {color: 'white', fontSize: 13}},
                            'titleTextStyle': {color: 'white'},
                            chartArea: {
                                left: "0%",
                                top: "20%",
                                height: "100%",
                                width: "100%"
                            },
                            slices: {
                                0: {color: '#81b313'},
                                1: {color: '#df5041'},
                                2: {color: 'orange'}
                            }
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
                        chart.draw(data, options);
                    }

                    document.addEventListener('DOMContentLoaded', function load() {
                        if (!window.jQuery) return setTimeout(load, 300);
                        $(window).resize(function () {
                            drawChart();
                        });
                    }, false);
                </script>
            </div>
        </div>
    </div>
@endsection
