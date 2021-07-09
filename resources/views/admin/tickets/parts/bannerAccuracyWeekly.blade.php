   @php
   $tickets = App\Ticket::where('created_at','>=', \Carbon\Carbon::now()->startOfWeek())->where('status', '=', '1')->count() * 100;
   $good = \App\Ticket::where('created_at','>=', \Carbon\Carbon::now()->startOfWeek())->where('status', '=', '1')->count() + \App\Ticket::where('created_at','>', \Carbon\Carbon::now()->startOfWeek())->where('status', '=', '2')->count();
  if($good == 0) {
    $acc = 0;
  } else {
    $acc = round($tickets / $good, 0);
  }
  $color = 'great';
  switch (true) {
    case $acc < 33:
        $color = 'danger';
        break;
    case $acc < 66:
        $color = 'good';
        break;
    case $acc <= 100:
        $color = 'great';
        break;
    default:
    $color = 'warning';
      break;
}
  @endphp
                  <div class="col-xl-3 col-md-6 mb-2">
              <div class="card border-left-{{ $color }} shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-{{ $color }} text-uppercase mb-1">Přesnost (TÝDEN)</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{  $acc  }}%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{  $acc  }}%" aria-valuenow="{{  $acc  }}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
