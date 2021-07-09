<div class="col-xl-3 col-md-6 mb-2">
              <div class="card animated--grow-in border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Výdělek (měsíc)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ round(\App\Subscription::whereBetween('from', [\Carbon\Carbon::now()->subDays(30), \Carbon\Carbon::now()])->get()->sum('price'),0) }} Kč</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>