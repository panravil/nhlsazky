@php
    $count_celkem_1 = $match->contestTips->where('tip', '=', 1)->count();
    $count_celkem_2 =  $match->contestTips->where('tip', '=', 2)->count();
    $count_celkem = $match->contestTips->count();
    $jedno_procento = $count_celkem / 100;
    if ($jedno_procento == 0) {
        $vysledek = 0;
        $vysledek2 = 0;
    } else {
        $vysledek = $count_celkem_1 / $jedno_procento;
        $vysledek2 = 100 - $vysledek;
    }
    $zapas_status = "";
    $soutez_status = false;

    if (\Illuminate\Support\Facades\Auth::guest()) {
        $soutez_status = false;
                $hlas1 = "";
                $hlas2 = "";
    } else {
            if (\Carbon\Carbon::now() < $match->start) {
        $soutez_status = true;
        $row_uz = $match->contestTips->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->first();
        if ($row_uz) {
            if ($row_uz->tip == 1) {
                $hlas1 = "hlasoval";
            } else {
                $hlas1 = "";
            }
            if ($row_uz->tip == 2) {
                $hlas2 = "hlasoval";
            } else {
                $hlas2 = "";
            }
            $zapas_status = "již tipováno";
            $soutez_status = false;
        } else {
            $soutez_status = true;
        }
    } else {
        $soutez_status = false;
        $row_uz = $match->contestTips->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->first();
        if ($row_uz) {
            if ($row_uz->tip == 1) {
                $hlas1 = "hlasoval";
            } else {
                $hlas1 = "";
            }
            if ($row_uz->tip == 2) {
                $hlas2 = "hlasoval";
            } else {
                $hlas2 = "";
            }
        }
        $zapas_status = 'již nelze tipovat';
    }
    }
@endphp

@if ($soutez_status)
    <div id="{{ $match->id }}" class="soutez_zapas list-group-item">
        <div class="row zapas-info">
            <span style="font-weight: 600;">{{ $match->start->format('d.m. H:i') }}</span>
        </div>
        <div class="row d-flex flex-row justify-content-around zapas-teams">
            <a href="{{ route('contestTip', [$match->id, 1]) }}" class="col-5 soutez_tym d-flex grow align-items-center">
                <img src="/images/tymy_loga/{{ $match->host->icon }}?re" alt="{{ $match->host->name }}"
                     title="{{ $match->host->name }}"
                     class="img-responsive img-team-soutez"><span
                    class="d-none d-sm-block tym_name"> {{ $match->host->name }}</span>
            </a>
            <div class="col-2 text-center" style="padding-left: 0; padding-right: 0;">
                <div class="hlavni_zapas_stred_vs">vs</div>
            </div>
            <a href="{{ route('contestTip', [$match->id, 2]) }}" class="col-5 soutez_tym d-flex grow align-items-center">
                <img src="/images/tymy_loga/{{ $match->guest->icon }}?re" alt="{{ $match->guest->name }}"
                     title="{{ $match->guest->name }}"
                     class="img-responsive img-team-soutez"><span
                    class="d-none d-sm-block tym_name"> {{ $match->guest->name }}</span>
            </a>
        </div>
    </div>
@else
    <div  id="{{ $match->id }}"  class="soutez_zapas list-group-item soutez_late">
        <div class="row zapas-info">
            <span style="font-weight: 600;">{{ $match->start->format('d.m. H:i') }}</span>
            <span class="badge hlavni_zapas_END" style="position: absolute; right: 5px;">{{ $zapas_status }}</span>
        </div>
        <div class="row d-flex flex-row justify-content-around zapas-teams">
            <div class="col-5 soutez_tym {{ $hlas1?? '' }}">
                <img src="/images/tymy_loga/{{ $match->host->icon }}" alt="{{ $match->host->name }}"
                     title="{{ $match->host->name }}"
                     class="img-responsive img-team-soutez"><span
                    class="d-none d-sm-block tym_name"> {{ $match->host->name }}</span>
                <div
                    style="border-radius: 2px; background: linear-gradient(90deg, green {{ $vysledek }}%, red 1%);font-size:6px;height:10px;border:0px solid #333;margin-top:3px;"></div>
            </div>
            <div class="col-2 text-center" style="padding-left: 0; padding-right: 0;">
                <div class="hlavni_zapas_stred_vs">vs</div>
            </div>
            <div class="col-5 soutez_tym {{ $hlas2?? '' }}">
                <img src="/images/tymy_loga/{{ $match->guest->icon }}" alt="{{ $match->guest->name }}"
                     title="{{ $match->guest->name }}"
                     class="img-responsive img-team-soutez"><span
                    class="d-none d-sm-block tym_name"> {{ $match->guest->name }}</span>
                <div
                    style="border-radius: 2px; background: linear-gradient(90deg, green {{$vysledek2}}%, red 1%);font-size:6px;height:10px;border:0px solid #333;margin-top:3px;"></div>
            </div>
        </div>
    </div>
@endif
