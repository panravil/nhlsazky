@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')

              <div class="row">
                  @include('admin.tickets.parts.bannerTicketsTotal')
                  @include('admin.tickets.parts.bannerTicketsMonthly')
                  @include('admin.tickets.parts.bannerAccuracyTotal')
                  @include('admin.tickets.parts.bannerAccuracyMonthly')
          </div>

          <div class="d-flex align-items-center justify-content-between mb-3">
                            <ul class="nav nav-pills">
  <li class="nav-item  badge  badge-pill dropdown">
  <button class="btn btn-sm btn-light badge-pill  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-archive"></i> Balíček
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                @foreach(\App\Package::all() as $package)
                <a class="dropdown-item" href="{{ route('admin.tikety.index', ['package' => $package->id]) }}">{{ $package->title }}</a>
              @endforeach
  </div>

  </li>
                                 <li class="nav-item badge  badge-pill badge-light">
    <a href="{{ route('admin.tikety.index') }}" class="nav-link {{ $request->input() == null ? 'active' : '' }}">Všechny</a>
  </li>
</ul>
              <div><a href="{{ route('admin.sendNotifications') }}" class="btn rounded-pill btn-primary shadow-sm"><i class="fas fa-mail-bulk fa-sm text-white"></i>
                <span class="d-none d-sm-inline"> Notifikovat</span></a>
               <a href="{{ route('admin.tikety.create') }}" class="btn rounded-pill btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white"></i>
                <span class="d-none d-sm-inline"> Přidat</span></a></div>

          </div>
    <div class="row">
                  <div class="col-12 col-sm-12 col-md-12  col-lg-12 col-xl-4">

            <div class="card animated--grow-in shadow mb-4">
                <a href="#collapseLive" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseLive">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Nevyřešené tikety</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseLive">
                    <div class="card-body p-0">
                        <div class="list-group">
                      @foreach($ticketsLive as $ticket)
                                        @include('admin.tickets.parts.card', $ticket)
                                    @endforeach
                        </div>
                    </div>
                    @if($ticketsLive->hasMorePages())
                    <div class="card-footer">
                            {{ $ticketsLive->appends(['hidden' => Request::input('hidden')])->appends(['done' => Request::input('done')])->onEachSide(0)->links() }}
                    </div>
                        @endif()
                </div>

            </div>
        </div>
        @if($ticketsHidden->count() > 0)
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">

            <div class="card animated--grow-in shadow mb-4">
                <a href="#collapseHidden" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseHidden">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Schované</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseHidden">
                    <div class="card-body p-0">
                        <div class="list-group">
                      @foreach($ticketsHidden as $ticket)
                                        @include('admin.tickets.parts.card', $ticket)
                                    @endforeach
                        </div>
                    </div>
                    @if($ticketsHidden->hasMorePages())
                    <div class="card-footer">
                            {{ $ticketsHidden->appends(['live' => Request::input('live')])->appends(['done' => Request::input('done')])->onEachSide(0)->links() }}
                    </div>
                        @endif()
                </div>

            </div>
        </div>
        @endif
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4">

            <div class="card animated--grow-in shadow mb-4">
                <a href="#collapseAll" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="collapseAll">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Vyřešené</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseAll">
                    <div class="card-body p-0">
                        <div class="list-group">
                      @foreach($ticketsDone as $ticket)
                                        @include('admin.tickets.parts.card', $ticket)
                                    @endforeach
                        </div>
                    </div>
                    @if($ticketsDone->hasMorePages())
                    <div class="card-footer">
                            {{ $ticketsDone->appends(['hidden' => Request::input('hidden')])->appends(['live' => Request::input('live')])->onEachSide(0)->links() }}
                    </div>
                        @endif()
                </div>

            </div>
        </div>
    </div>
@endsection
