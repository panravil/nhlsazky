@extends('clean.layouts.app')
@section('title')
Soutěž | NHL Sázení
@endsection
@section('page')
    <div class="container">
        <div class="row">
            <div class="col-md-12 content"  >
                <h1 class="page_tittle">Soutěž - tipy uživatele {{ $user->name }}</h1>
                <div class="row">
                    <div class="col-md-4 offset-md-2">
                        <div class="">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Celkem bodů:</td>
                                    <td style="text-align: right"><strong>{{ $user->contestTipsWeek->sum('result') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Celkový počet tipů:</td>
                                    <td style="text-align: right">
                                        <strong>{{ $user->contestTipsWeek->count() }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Počet úspěšných tipů:</td>
                                    <td class="vyhra" style="text-align: right"><strong>{{ $user->contestTipsWeek->where('result', '>', 0)->count() }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Počet neúspěšných tipů:</td>
                                    <td class="prohra" style="text-align: right"><strong>{{ $user->contestTipsWeek->where('result', '<', 0)->count() }}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-none d-sm-block col-md-4">
                        <div id="chart_div3"></div>
                    </div>
                </div>
                <div class="row" style="padding-top: 50px;">
                    <div class="col-12">
                        <div class="">
                            <table class="table table_tikety">
                                <thead>
                                <tr>
                                    <td>Datum zápasu</td>
                                    <td>Domácí</td>
                                    <td>Hosté</td>
                                    <td class="d-none d-sm-table-cell">Datum tipování</td>
                                    <td>Tip</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->contestTipsWeek->sortByDesc('datum') as $tip)
                                    <tr class="{{ $tip->match->winner == $tip->tip ? 'vyhra': ($tip->match->winner == 0 ? 'nevyhodnoceno': 'prohra')}}">
                                    <td width="150">{{ $tip->match->start->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <div class="soutez_zapasy_obrtymu"><img
                                                src="/images/tymy_loga/{{ $tip->match->host->icon }}" width="30"
                                                height="30" align="middle" alt="{{ $tip->match->host->name }}"></div>
                                        <div class="soutez_zapasy_nazev_tymu d-none d-sm-block">{{ $tip->match->host->name }}</div>
                                    </td>
                                    <td>
                                        <div class="soutez_zapasy_obrtymu"><img
                                                src="/images/tymy_loga/{{ $tip->match->guest->icon }}" width="30"
                                                height="30" align="middle" alt="{{ $tip->match->guest->name }}"></div>
                                        <div class="soutez_zapasy_nazev_tymu d-none d-sm-block">{{ $tip->match->guest->name }}</div>
                                    </td>
                                    <td width="150" class="d-none d-sm-table-cell">{{ $tip->datum->format('d.m.Y H:i') }}
                                    </td>
                                        @if($tip->match->winner == $tip->tip)
                                        <td class="soutez_tipy_ok">
                                            <small class='d-none d-sm-block'>(uhodnuto)</small>
                                        </td>
                                            @elseif($tip->match->winner == 0)
                                        <td>
                                            <small>(nevyhodnoceno)</small>
                                        </td>
                                            @else
                                        <td class="soutez_tipy_ko">
                                            <small class='d-none d-sm-block'>(neuhodnuto)</small>
                                        </td>
                                            @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin:0;padding:0;">
                    <div class="col-md-12">
                        <nav>
                            <ul class="pagination" style="padding:0;"></ul>
                        </nav>
                    </div>
                </div>
                <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript">
                    document.addEventListener('DOMContentLoaded', function load() {
                        if (!window.jQuery) return setTimeout(load, 300);
                        $(window).resize(function () {
                            drawChart();
                        });
                    }, false);
                </script>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", {packages: ["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Výhry', {{ $user->contestTipsWeek->where('result', '>', 0)->count() }}],
                            ['Prohry', {{ $user->contestTipsWeek->where('result', '<', 0)->count() }}]
                        ]);
                        var options = {
                            pieHole: 0.4,
                            height: "150",
                            width: "100%",
                            'backgroundColor': 'none',
                            'backgroundColor.stroke': 'red',
                            'legend': {position: 'labeled', textStyle: {color: 'black', fontSize: 13}},
                            'titleTextStyle': {color: 'white'},
                            chartArea: {
                                height: "100%",
                                width: "100%"
                            },
                            slices: {
                                0: {color: '#81b313'},
                                1: {color: '#df5041'},
                                2: {color: 'orange'}
                            }
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
