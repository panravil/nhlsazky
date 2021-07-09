@php
    $premium = App\Package::findOrFail(1);
    $mega = App\Package::findOrFail(2);
    $live = App\Package::findOrFail(3);
    $allin = App\Package::findOrFail(4);
@endphp
@extends('clean.layouts.app')

@section('page')
   <div class="container my-3 my-md-4">
      <div class="row">
        <br/>
        <div class="col text-center">
          <h2>Statistiky</h2>
        </div>

      </div>
      <div class="row text-center" id="counters">
        <div class="col-6 col-md-3 col-lg">
          <div class="counter">
            <i class="fas fa-clipboard-list fa-2x"></i>
            <h2 id="tip_count" class="timer count-title count_number" data-to="100" data-speed="1500"><span>{{\App\Ticket::where('show', 1)->where('status', '!=', 0)->count() }}</span>
            </h2>
            <p class="count-text ">Tipů</p>
          </div>
        </div>
        <div class="col-6 col-md-3 col-lg">
          <div class="counter">
            <i class="fas fa-clipboard-check fa-2x"></i>
            <h2 class="timer count-title count_number" data-to="157" data-speed="1500"><span>{{ \App\Ticket::where('show', 1)->where('status', '=', 1)->count() }}</span></h2>
            <p class="count-text ">Úspěšných tipů</p>
          </div>
        </div>
        <div class="d-none d-lg-block col-lg">
          <div class="counter">
            <i class="fas fa-thumbs-up fa-2x"></i>
            <h2 id="avg_odd" class="timer count-title count_number_decimal" data-to="1700" data-speed="1500"><span>{{ round(\App\Ticket::where('show', 1)->where('status', '!=', 0)->avg('odds'), 2) }}</span>
            </h2>
            <p class="count-text ">Průměrný kurz</p>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg">
          <div class="counter">
            <i class="fas fa-piggy-bank fa-2x"></i>
            <h2 class="timer count-title count_number" data-to="11900" data-speed="1500"><span>{{ \App\Ticket::where('show', 1)->where('status', '!=', 0)->sum('profit') * 500,0 }}</span> Kč</h2>
            <p class="count-text ">Čitý získ</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 content">
                <div class="row" style="padding-left: 10px; padding-right: 10px; ">
                    <a href="{{ route('statsPackage', 'premium-tipy') }}" class="col-12 col-sm-6 col-md-3 globalStat"
                       style="padding: 5px;">
                        <div
                            class="statistikyhl_tlacitko bg-premium-gradient">
                            <h4 class="text-white">PREMIUM TIPY</h4>
                        </div>
                        <div class="globalStatTable">
                            <table class="table table-striped ">
                                <tbody>
                                <tr>
                                    <td style="width: 60%">Počet tipů:</td>
                                    <td style="width: 40%">
                                        <strong>{{$premium->tickets->where('show', 1)->where('status', '!=', 0)->count() }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Průměrný kurz:</td>
                                    <td>
                                        <strong>{{ round($premium->tickets->where('show', 1)->where('status', '!=', 0)->avg('odds'), 2) }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                @if($premium->tickets->where('status', 2)->sum('cost') < 1)
                                    <tr>
                                        <td>ROI:</td>
                                        <td><strong>100%</strong></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>ROI:</td>
                                        <td>
                                            <strong>{{ round(100*($premium->tickets->where('status', 1)->sum('profit') / $premium->tickets->where('status', 2)->sum('cost')),2) }}
                                                %</strong></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Profit v jednotkách:</td>
                                    <td>
                                        <strong>{{ round( $premium->tickets->where('show', 1)->where('status', '!=', 0)->sum('profit')) }}</strong>
                                    </td>
                                </tr>
                                <tr>

                                    <td>Čistý zisk v Kč:</td>

                                    <td>
                                        <strong> {{ number_format($premium->tickets->where('show', 1)->where('status', '!=', 0)->sum('profit') * 500,0, ' ', ' ') }}
                                            Kč*</strong></td>

                                </tr>
                                </tbody>
                            </table>
                            <div class="btn btn-primary btn-block">ZOBRAZIT VŠE</div>
                        </div>
                    </a>
                    <a href="{{ route('statsPackage', 'mega-kurzy') }}" class="col-12 col-sm-6 col-md-3 globalStat"
                       style="padding: 5px;">
                        <div
                            class="statistikyhl_tlacitko bg-mega-gradient">
                            <h4 class="text-white">MEGA KURZY</h4></div>
                        <div class="globalStatTable">
                            <table class="table table-striped ">
                                <tbody>
                                <tr>
                                    <td style="width: 60%">Počet tipů:</td>
                                    <td style="width: 40%">
                                        <strong>{{ $mega->tickets->where('show', 1)->where('status', '!=', 0)->count()}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Průměrný kurz:</td>
                                    <td>
                                        <strong>{{ round($mega->tickets->where('show', 1)->where('status', '!=', 0)->avg('odds'), 2) }}</strong>
                                    </td>
                                </tr>
                                @if($mega->tickets->where('status', 2)->sum('cost') < 1)
                                    <tr>
                                        <td>ROI:</td>
                                        <td><strong>100%</strong></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>ROI:</td>
                                        <td>
                                            <strong>{{ round(100*($mega->tickets->where('status', 1)->sum('profit') / $mega->tickets->where('status', 2)->sum('cost')),2) }}
                                                %</strong></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Profit v jednotkách:</td>
                                    <td>
                                        <strong>{{ round( $mega->tickets->where('show', 1)->where('status', '!=', 0)->sum('profit')) }}</strong>
                                    </td>
                                </tr>
                                <tr>

                                    <td>Čistý zisk v Kč:</td>

                                    <td>
                                        <strong> {{ number_format($mega->tickets->where('show', 1)->where('status', '!=', 0)->sum('profit') * 500,0, ' ', ' ') }}
                                            Kč*</strong></td>

                                </tr>
                                </tbody>
                            </table>
                            <div class="btn btn-primary btn-block">ZOBRAZIT VŠE</div>
                        </div>
                    </a>
                    <a href="{{ route('statsPackage', 'live-sazky') }}" class="col-12 col-sm-6 col-md-3 globalStat"
                       style="padding: 5px;">
                        <div
                            class="statistikyhl_tlacitko bg-live-gradient">
                            <h4 class="text-white">LIVE SÁZKY</h4></div>
                        <div class="globalStatTable">
                            <table class="table table-striped ">
                                <tbody>
                                <tr>
                                    <td style="width: 60%">Počet tipů:</td>
                                    <td style="width: 40%">
                                        <strong>{{$live->tickets->where('show', 1)->where('status', '!=', 0)->where('show', 1)->count() }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Průměrný kurz:</td>
                                    <td>
                                        <strong>{{ round($live->tickets->where('show', 1)->where('status', '!=', 0)->avg('odds'), 2) }}</strong>
                                    </td>
                                </tr>

                                @if($live->tickets->where('status', 2)->sum('cost') < 1)
                                    <tr>
                                        <td>ROI:</td>
                                        <td><strong>100%</strong></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>ROI:</td>
                                        <td>
                                            <strong>{{ round(100*($live->tickets->where('status', 1)->sum('profit') / $live->tickets->where('status', 2)->sum('cost')),2) }}
                                                %</strong></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Profit v jednotkách:</td>
                                    <td>
                                        <strong>{{ round( $live->tickets->where('show', 1)->where('status', '!=', 0)->sum('profit')) }}</strong>
                                    </td>
                                </tr>
                                <tr>

                                    <td>Čistý zisk v Kč:</td>

                                    <td>
                                        <strong> {{ number_format($live->tickets->where('show', 1)->where('status', '!=', 0)->sum('profit') * 500,0, ' ', ' ') }}
                                            Kč*</strong></td>

                                </tr>
                                </tbody>
                            </table>
                            <div class="btn btn-primary btn-block">ZOBRAZIT VŠE</div>
                        </div>
                    </a>
                    <a href="{{ route('statsPackage', 'all-in') }}" class="col-12 col-sm-6 col-md-3 globalStat"
                       style="padding: 5px;">
                        <div
                            class="statistikyhl_tlacitko bg-allin-gradient">
                            <h4 class="text-white">ALL-IN</h4>
                        </div>

                        <div class="globalStatTable">
                            <table class="table table-striped ">
                                <tbody>
                                <tr>
                                    <td style="width: 60%">Počet tipů:</td>
                                    <td style="width: 40%">
                                        <strong>{{\App\Ticket::where('show', 1)->where('status', '!=', 0)->count() }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Průměrný kurz:</td>
                                    <td>
                                        <strong>{{ round(\App\Ticket::where('show', 1)->where('status', '!=', 0)->avg('odds'), 2) }}</strong>
                                    </td>
                                </tr>

                                @if(\App\Ticket::where('show', 1)->where('status', '=', 2)->sum('cost') < 1)
                                    <tr>
                                        <td>ROI:</td>
                                        <td><strong>100%</strong></td>
                                    </tr>
                                @else

                                    <tr>
                                        <td>ROI:</td>
                                        <td>
                                            <strong>{{ round(100*(\App\Ticket::where('show', 1)->where('status', '=', 1)->sum('profit') / \App\Ticket::where('show', 1)->where('status', '=', 2)->sum('cost')),2) }}
                                                %</strong></td>
                                    </tr>   @endif
                                <tr>
                                    <td>Profit v jednotkách:</td>
                                    <td>
                                        <strong>{{ round( \App\Ticket::where('show', 1)->where('status', '!=', 0)->sum('profit')) }}</strong>
                                    </td>
                                </tr>
                                <tr>

                                    <td>Čistý zisk v Kč:</td>

                                    <td>
                                        <strong> {{ number_format(\App\Ticket::where('show', 1)->where('status', '!=', 0)->sum('profit') * 500,0, ' ', ' ') }}
                                            Kč*</strong></td>

                                </tr>
                                </tbody>
                            </table>
                            <div class="btn btn-primary btn-block">ZOBRAZIT VŠE</div>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div>



        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('clean.layouts.parts.bannerlong')
                </div>
            </div>
        </div>
   <section>
    @include('clean.home.parts.calculator')</section>
@endsection
