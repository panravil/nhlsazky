@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-5  pr-md-1 pr-lg-3 col-lg-5 col-xl-4">
            @include('admin.package.parts.card', $package)
@php
    $all_7 = App\Ticket::where('created_at','>', \Carbon\Carbon::now()->subDays(7))->where('show', '=', '1')->where('package_id', '=', $package->id)->count();
    $good_7 = App\Ticket::where('created_at','>', \Carbon\Carbon::now()->subDays(7))->where('show', '=', '1')->where('package_id', '=', $package->id)->where('status', '=', '1')->count();
    $profit7 =  App\Ticket::where('created_at','>', \Carbon\Carbon::now()->subDays(7))->where('status', '!=', '0')->where('show', '=', '1')->where('package_id', '=', $package->id)->sum('profit')*1000;
   if($good_7 == 0) {
     $acc = 0;
   } else {
     $acc = round(($good_7* 100) / $all_7, 0);
   }
  $color = 'warning';
   switch ($profit7) {
     case $profit7 < 0:
         $color = 'danger';
         break;
     case $profit7 == 0:
         $color = 'warning';
         break;
     case $profit7 > 0:
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
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Přesnost (7 dní)</div>
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
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all_7 }}</div>
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
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $good_7 }}</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-check fa-2x text-gray-300"></i>
            </div>
        </div>

</div>
    <div class="card-body border-left-{{ $color }} py-0 pb-3">
        <div class="row no-gutters pt-3 align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Zisk (7 dní)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $profit7 }} Kč</div>
            </div>
            <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
            </div>
        </div>
    </div>
</div>
        </div>
        <div class="col-12 col-sm-12 col-md-7 pl-md-1 pl-lg-3 col-lg-7 col-xl-8">

            <div class="card animated--grow-in shadow mb-4">
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Tikety</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body p-0">
                        <div class="list-group">
                      @foreach($tickets as $ticket)
                                        @include('admin.tickets.parts.card', $ticket)
                                    @endforeach
                        </div>
                    </div>
                    @if($tickets->hasMorePages())
                    <div class="card-footer">
                            {{ $tickets->links() }}
                    </div>
                        @endif()
                </div>

            </div>
        </div>
    </div>
@endsection
