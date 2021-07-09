@extends('clean.layouts.app')
@section('page')
    <div class="container my-3 my-md-4">
        <div class="row">
            <br/>
            <div class="col text-center">
                <h1 class="page_tittle text-up">Statistiky <span class="text-uppercase">{{$typ}}</span></h1>
            </div>

        </div>
        <div class="row text-center pt-3" id="counters">
            <div class="col-6 col-md-3 col-lg">
                <div class="counter">
                    <i class="fas fa-clipboard-list fa-2x"></i>
                    <h2 id="tip_count" class="timer count-title count_number" data-to="100" data-speed="1500">
                        <span>{{$tickets->where('show', 1)->count() }}</span>
                    </h2>
                    <p class="count-text ">Tipů</p>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg">
                <div class="counter">
                    <i class="fas fa-clipboard-check fa-2x"></i>
                    <h2 class="timer count-title count_number" data-to="157" data-speed="1500">
                        <span>{{ $tickets->where('status', 1)->count() }}</span></h2>
                    <p class="count-text ">Úspěšných tipů</p>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg">
                <div class="counter">
                    <i class="fas fa-thumbs-up fa-2x"></i>
                    <h2 id="avg_odd" class="timer count-title count_number_decimal" data-to="1700" data-speed="1500">
                        <span>{{ round($tickets->avg('odds'), 2) }}</span>
                    </h2>
                    <p class="count-text ">Průměrný kurz</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg">
                <div class="counter">
                    <i class="fas fa-piggy-bank fa-2x"></i>
                    <h2 class="timer count-title count_number" data-to="11900" data-speed="1500">
                        <span>{{ $tickets->sum('profit') * 500 }}</span>
                        Kč</h2>
                    <p class="count-text ">Čitý získ</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content">
                <div class="card">
                    <div class="row m-2">
                        @foreach($stats as $stat)
                            <div class="col-6 col-sm-4 col-md-2 no_padding" style="padding: 5px;"><a
                                    href="{{ route('statsDetail', [$typ, $stat->season, 'celkove-obdobi']) }}"
                                    class="statistikyhl_tlacitko bg-gradient"><br>
                                    <h2>sezóna {{  str_replace("-","/", $stat->season)}}</h2></a></div>
                        @endforeach
                    </div>
                    <div class="card-body pt-0">
                        <div class="row" style="margin-top:20px;">

                            <div class="col-md-4">

                                <table class="table table-striped bg-secondary">
                                    <tbody>
                                    <tr>
                                        <td style="width: 60%">Počet tipů:</td>
                                        <td style="width: 40%"><strong>{{$tickets->where('show', 1)->count() }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Výherních:</td>
                                        <td><strong>{{ $tickets->where('status', 1)->count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Proherních:</td>
                                        <td><strong>{{ $tickets->where('status', 2)->count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Vrácen vklad:</td>
                                        <td><strong>{{ $tickets->where('status', 3)->count() }}</strong></td>
                                    </tr>
                                    @if($tickets->where('status', '!=', 0)->count() > 0)
                                        <tr>

                                            <td>Úspěšnost tipů v %:</td>

                                            <td>
                                                <strong>{{ round(100*(($tickets->where('status', 1)->count() +$tickets->where('status', 3)->count()) / $tickets->where('status', '!=', 0)->count()),2) }}
                                                    %</strong></td>

                                        </tr>
                                    @else
                                        <tr>

                                            <td>Úspěšnost tipů v %:</td>

                                            <td><strong>100%</strong></td>

                                        </tr>
                                    @endif
                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-4">

                                <table class="table table-striped bg-secondary">

                                    <tbody>

                                    <tr>

                                        <td style="width: 60%">Průměrný kurz:</td>

                                        <td style="width: 40%"><strong>{{ round($tickets->avg('odds'), 2) }}</strong>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td>Průměrný vklad:</td>

                                        <td><strong>{{ round($tickets->avg('cost'), 2) }} jednotek</strong></td>

                                    </tr>
                                    @if($tickets->where('status', 2)->sum('cost') < 1)
                                        <tr>
                                            <td>ROI:</td>
                                            <td><strong>100%</strong></td>
                                        </tr>
                                    @else
                                        <tr>

                                            <td>ROI:</td>

                                            <td>
                                                <strong>{{ round(100*($tickets->where('status', 1)->sum('profit') / $tickets->where('status', 2)->sum('cost')),2) }}
                                                    %</strong></td>

                                        </tr>   @endif


                                    <tr>

                                        <td>Profit v jednotkách:</td>

                                        <td><strong>{{ round( $tickets->sum('profit')) }}</strong></td>

                                    </tr>

                                    <tr>

                                        <td>Čistý zisk v Kč:</td>

                                        <td><strong>{{ number_format($tickets->sum('profit') * 500,0, ' ', ' ') }}
                                                Kč*</strong>
                                        </td>

                                    </tr>

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-4">
                                <div id="chart_div2">
                                </div>

                                <div class="text-right" style="float: right">* 1 jednotka = 500 Kč</div>
                            </div>

                        </div>
                    </div>
                </div>

                    @include('clean.layouts.parts.bannerlong')

                @if(!$tickets->isEmpty())
                    <hr>
                    <h3 class="text-center">Historie tiketů</h3>
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
                            @foreach($tickets_old as $ticket)
                                @include('front.stats.detail.ticket', $ticket)
                            @endforeach
                        </table>
                    </div>
                @else

                    <h2>V tomto období nebyl přidán žádný tip</h2>
                @endif

                <div class="row pt-3 pt-md-2">
                    <div class="col-md-12">
                        {{ $tickets_old->links()}}
                    </div>
                </div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                <script type="text/javascript">

                    google.charts.load("current", {packages: ["corechart"]});

                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([

                            ['Task', 'Hours per Day'],

                            ['Výhry', {{ $tickets->where('status', 1)->count() }}],

                            ['Prohry', {{ $tickets->where('status', 2)->count() }}]

                        ]);


                        var options = {

                            title: "Celkové statistiky za všechny sezóny",

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
