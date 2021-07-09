@php
    $count_celkem_1 = $template->contestTips->where('tip', '=', 1)->count();
    $count_celkem_2 =  $template->contestTips->where('tip', '=', 2)->count();
    $count_celkem = $template->contestTips->count();
    $jedno_procento = $count_celkem / 100;
    if ($jedno_procento == 0) {
        $vysledek = 0;
        $vysledek2 = 0;
    } else {
        $vysledek = $count_celkem_1 / $jedno_procento;
        $vysledek2 = 100 - $vysledek;
    }
@endphp


<div class="text-center">{{ $template->start }}</div>
<a class="list-group-item list-group-item-action d-flex align-items-center p-0 justify-content-between"
   href="{{ route('admin.zapasy.show', $template->id) }}">
    <div
        class="text-center flex-grow-1 {{ $template->winner == 1 ? 'border-bottom-success bg-light font-weight-bold' : 'border-bottom-danger' }}">
        <img src="{{ asset('images/tymy_loga/' . $template->host->icon) }}" alt="logo" height="40px"/>
        <h4 class="text-center">{{$template->score_host }}</h4>
    </div>
    <div
        class="text-center flex-grow-1 {{ $template->winner == 2 ? 'border-bottom-success bg-light font-weight-bold' : 'border-bottom-danger' }}">
        <img src="{{ asset('images/tymy_loga/' . $template->guest->icon) }}" alt="logo" height="40px"/>
        <h4 class="text-center">{{$template->score_guest }}</h4></div>
</a>
<div class="progress progress-sm m-0 bg-{{ $vysledek2 > $vysledek? 'danger': 'success' }}">
    <div class="progress-bar bg-{{ $vysledek2 > $vysledek? 'success': 'danger' }}" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
         aria-valuemax="{{ $vysledek }}"></div>
</div>
