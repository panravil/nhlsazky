@extends('admin.layouts.app')

@section('page')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">Uživatelé</h4>
    </div>
    <!-- Content Row -->
    <div class="row animated--grow-in">
        @include('admin.users.parts.bannerUsersTotal')
        @include('admin.users.parts.bannerUsersMonthly')
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Uživatelů (Dnes)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\User::where('created_at', '>=', \Carbon\Carbon::now()->startOfDay())->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-2">
            <div class="px-0 py-0 h-100">
                <div class="card-body px-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col d-flex justify-content-md-end justify-content-between text-center">
                            <a href="{{ route('admin.tikety.create') }}"
                               class="btn btn-circle btn-lg btn-primary mx-2 shadow"><i
                                    class="fas fa-clipboard-list text-white fa-fw "></i></a>
                            <a href="{{ route('admin.udalosti.index') }}"
                               class="btn btn-circle btn-lg btn-primary mx-2 shadow"><i
                                    class="fas fa-newspaper text-white fa-fw "></i></a>
                            <a href="{{ route('admin.soutez') }}" class="btn btn-circle btn-lg btn-primary mx-2 shadow"><i
                                    class="fas fa-trophy text-white fa-fw "></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Počet nových registrací</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body px-0">
                    <div class="chart-area">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Balíčky</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body px-0">
                    <div class="chart-area">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        {!! $chart2->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">Tikety</h4>
            <a href="{{ route('admin.tikety.create') }}" class="btn rounded-pill btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white"></i>
                <span class="d-none d-sm-inline"> Přidat</span></a>
    </div>
        <div class="row">
                  @include('admin.tickets.parts.bannerTicketsTotal')
                  @include('admin.tickets.parts.bannerTicketsMonthly')
                  @include('admin.tickets.parts.bannerAccuracyMonthly')
                  @include('admin.tickets.parts.bannerAccuracyWeekly')</div>
            @if($ticketsLive->count() > 0)

    <div class="row pb-4 pt-3">
                      @foreach($ticketsLive as $ticket)
                  <div class="col-12 col-sm-12 col-md-12  col-lg-12 col-xl-4">
                      <div class="list-group shadow">
                                        @include('admin.tickets.parts.card', $ticket)
        </div></div>
                                    @endforeach

    </div>
                @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">Transakce</h4>
    </div>
    <div class="row animated--grow-in">
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tranakce (Celkem)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Transaction::where([
                                ['status', '=', 'Succeeded']])->sum('priceCZK') }}
                                Kč
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tranakce (Měsíc)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Transaction::where([['created_at', '>=', \Carbon\Carbon::now()->startOfMonth()],
                                ['status', '=', 'Succeeded']])->sum('priceCZK') }}
                                Kč
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tranakce (Minulý
                                měsíc)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Transaction::where([['created_at', '>=', \Carbon\Carbon::now()->addMonths(-1)->startOfMonth()],
                                ['created_at', '<=', \Carbon\Carbon::now()->addMonths(-1)->endOfMonth()],['status', '=', 'Succeeded']])->sum('priceCZK') }}
                                Kč
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="col-xl-3 col-md-6 mb-2">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tranakce (Dnes)
                            </div>
                            <div
                                class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Transaction::where([['created_at', '>=', \Carbon\Carbon::now()->startOfDay()],['status', '=', 'Succeeded']])->sum('priceCZK') }}
                                Kč
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Poslední transakce</h6>
                </div>
                <div class="card-body p-0 pt-md-3 pb-md-1 pl-lg-4 pr-lg-4">
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Tarif</th>
                                <th>Uživatel</th>
                                <th class="d-none d-sm-table-cell">Datum aktivace</th>
                                <th width="10px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Transaction::where('status', '=', 'Succeeded')->OrderBy('created_at','desc')->limit(10)->get() as $transaction)

                                <tr>
                                    <td>
                                        <a class="badge badge-{{ $transaction->activated_date ? 'success': 'warning'}}"
                                           href="{{ route('admin.tarify.show', $transaction->tariff->id) }}">{{ $transaction->tariff->title }}
                                            <span>({{ $transaction->priceCZK }}Kč)</span></a>
                                    </td>
                                    @if($transaction->user)
                                        <td><a href="{{ route('admin.uzivatele.show', $transaction->user->id) }}">{{ $transaction->user->email }}</a></td>
                                        @else
                                    <td>{{ $transaction->user_email }}</td>
                                        @endif
                                    <td class="d-none d-sm-table-cell">{{ $transaction->activated_date }}</td>
                                    <td>
                                        X
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0 text-gray-800">Zápasy</h4>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Následující zápasy</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body p-0 p-md-2">
                    <div class="list-group-flush">
                        @foreach($nextMatches as $template)
                            @include('admin.matches.parts.match', $template)
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Odehrané zápasy</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body p-0 p-md-2">
                    <div class="list-group-flush">
                        @foreach($lastDoneMatches as $template)
                            @include('admin.matches.parts.match', $template)
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    {!! $chart2->script() !!}
@endsection
