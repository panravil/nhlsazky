<section>
    <div class="container my-3 my-md-4">
      <div class="row">
        <br/>
        <div class="col text-center">
          <h2>Historie v číslech</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        </div>

      </div>
      <div class="row text-center" id="counters">
        <div class="col-6 col-md-3 col-lg">
          <div class="counter">
            <i class="fas fa-clipboard-list fa-2x"></i>
            <h2 id="tip_count" class="timer count-title count_number" data-to="100" data-speed="1500"><span>{{ \App\Ticket::where('show', 1)->count() }}</span>
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
    @include('clean.home.parts.calculator')

<div class="skew-cc-black-dark"></div>
</section>
