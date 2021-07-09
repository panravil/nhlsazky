<!-- Dropdown Card Example -->
<div
    class="card animated--grow-in {{ $package->show == 0 ? 'border-left-dark' : ''}} shadow mb-2 text-white {{ $package->color }}">
    <!-- Card Header - Dropdown -->
    <div
        class="card-header border-bottom-0 pb-0 d-flex flex-row align-items-center justify-content-between bg-transparent">
        <a href="{{ route('admin.balicky.show', $package->id) }}" class="text-white"><h6
                class="m-0 font-weight-bold">{{ $package->title }}</h6>
        </a>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Zobrazit:</div>
                <a class="dropdown-item" href="{{ route('admin.balicky.show', $package->id) }}"><i
                        class="fas fa-archive fa-fw"></i> Balíček</a>
                <a class="dropdown-item" href="{{ route('admin.balicky.show', $package->id) }}"><i
                        class="fas fa-archive fa-fw"></i> Tarify</a>
                <a class="dropdown-item" href="{{ route('admin.tarify.index') }}"><i
                        class="fas fa-clipboard-list fa-fw"></i> Tikety</a>
                <a class="dropdown-item" href="{{ route('admin.uzivatele.index', ['package' => $package->id])}}"><i
                        class="fas fa-users fa-fw"></i> Lidi</a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-header">Akce:</div>
                <a class="dropdown-item" href="{{ route('admin.tikety.create') }}"><i
                        class="fas fa-clipboard fa-fw"></i> Přidat tiket</a>
                <form action="{{ route('admin.balicky.update', $package->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="action" value="{!! !$package->show == 1 ? 'show' : 'hide' !!}">
                    @method('PATCH')
                    <button class="dropdown-item"
                            type="submit">{!! $package->show == 1 ? '<i class="fas fa-eye-slash fa-fw"></i> Schovat' : '<i class="fas fa-eye fa-fw"></i> Zobrazit'   !!}</button>
                </form>

                <a class="dropdown-item" href="{{ route('admin.balicky.index', $package->id) }}"><i
                        class="fas fa-bell fa-fw"></i> Notifikovat</a>
                <a class="dropdown-item" href="{{ route('admin.balicky.edit', $package->id)}}"><i
                        class="fas fa-edit fa-fw"></i> Upravit</a>

            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <h6 class="">Celkem tiketů: <span class="float-right badge badge-light">{{$package->tickets->count()}}</span>
        </h6>
         <h6 class="">Počet lidí: <span class="float-right badge badge-light">{{ $package->subscriptionsValid->count() }}</span></h6>

        <hr class="bg-light">
        @if($package->note)
            <a href="#" class="badge badge-pill badge-light" data-toggle="collapse"
               data-target="#collapse_{{ $package->id }}" aria-expanded="false"
               aria-controls="#collapse_{{ $package->id }}">
                Poznámka
            </a>
        @endif

        <div
            class="badge badge-pill badge-light">{!! $package->show == 1 ? '<i class="fas fa-eye fa-fw"></i>' : '<i class="fas fa-eye-slash fa-fw"></i>'   !!}</div>
        @if($package->tickets->count() > 0)
            <a href="{{ route('admin.tikety.index', ['package' => $package->id]) }}"
               class="badge badge-pill badge-light">Tikety</a>
        @endif

    <!-- Card Content - Collapse -->
        <div class="collapse" id="collapse_{{ $package->id }}">
            <small class="card-text">{{$package->desc}}</small>
        </div>
    </div>
</div>

@php
    $currentMonth = date('m');
    if ($package->id != 4) {
    $all_30 = App\Ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('package_id', '=', $package->id)->where('show', '=', '1')->count();
    $good_30 = App\Ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('package_id', '=', $package->id)->where('show', '=', '1')->where('status', '=', '1')->count();
    $profit =  App\Ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('package_id', '=', $package->id)->where('show', '=', '1')->where('status', '!=', '0')->sum('profit') *1000;
    } else {
    $all_30 = App\Ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('show', '=', '1')->count();
    $good_30 = App\Ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('show', '=', '1')->where('status', '=', '1')->count();
    $profit =  App\Ticket::whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('status', '!=', '0')->where('show', '=', '1')->sum('profit')*1000;
    }
   if($good_30 == 0) {
     $acc = 0;
   } else {
     $acc = round(($good_30* 100) / $all_30, 0);
   }
 $color = 'warning';
   switch ($profit) {
     case $profit < 0:
         $color = 'danger';
         break;
     case $profit == 0:
         $color = 'warning';
         break;
     case $profit > 0:
         $color = 'great';
         break;
     default:
     $color = 'warning';
       break;
 }
@endphp

<div class="card shadow mb-4 animated--grow-in">
    <div class="card-body border-left-{{ $color }} pb-0 pt-3">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Přesnost (MĚSÍC)</div>
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{  $acc  }}%</div>
                    </div>
                    <div class="col">
                        <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{  $acc  }}%"
                                 aria-valuenow="{{  $acc  }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
            </div>
        </div>

</div>
    <div class="card-body border-left-{{ $color }} py-0">
        <div class="row no-gutters pt-3 align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Tiketů (Celkem)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all_30 }}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
        </div>

</div>
    <div class="card-body border-left-{{ $color }}  py-0">
        <div class="row no-gutters pt-3 align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Tiketů (Vyhraných)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $good_30 }}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-check fa-2x text-gray-300"></i>
            </div>
        </div>

</div>
    <div class="card-body border-left-{{ $color }} py-0 pb-3">
        <div class="row no-gutters pt-3 align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Zisk (MĚSÍC)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $profit }} Kč</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>

                        <div class="card animated--grow-in shadow mb-4">
                <a href="#tariffsCard_{{ $package->id }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="tariffsCard_{{ $package->id }}">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-paper-plane"></i> Tarify</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="tariffsCard_{{ $package->id }}">
                    <div class="card-body p-0">
                        <div class="list-group">
                      @foreach($package->tariffs as $tarif)
                          <a class="list-group-item" href="{{ route('admin.tarify.show', $tarif->id) }}">{{ $tarif->title }}</a>
                                    @endforeach
                        </div>
                    </div>
                </div>

            </div>
