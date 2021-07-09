@extends('admin.layouts.app')

@section('page')
    <!-- Page Heading -->

    <!-- Content Row -->
    <div class="row animated--grow-in">
        @include('admin.users.parts.bannerUsersTotal')
        @include('admin.users.parts.bannerUsersMonthly')
        @include('admin.package.parts.bannerEarningTotal')
        @include('admin.package.parts.bannerEarningAverage')
        @include('admin.package.parts.bannerSubsActive')
        @include('admin.package.parts.bannerSubsAverage')
        @include('admin.ticket.parts.bannerTicketsTotal')
        @include('admin.ticket.parts.bannerTicketsMonthly')
        @include('admin.ticket.parts.bannerAccuracyTotal')
        @include('admin.ticket.parts.bannerAccuracyMonthly')
        @include('admin.contacts.parts.bannerMails')
        <div class="col-xl-3 col-md-6 mb-2">
            <div href="{{ route('admin.tikety.create') }}" class="px-0 py-0 h-100">
                <div class="card-body px-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col d-flex justify-content-md-end justify-content-between text-center">
                            <a href="{{ route('admin.tikety.create') }}"
                               class="btn btn-circle btn-lg btn-primary mx-2 shadow"><i
                                    class="fas fa-clipboard-list  fa-fw "></i></a>
                            <a href="{{ route('admin.tarify.create') }}"
                               class="btn btn-circle btn-lg btn-primary mx-2 shadow"><i
                                    class="fas fa-box fa-fw "></i></a>
                            <a href="{{ route('admin.zapas.create') }}"
                               class="btn btn-circle btn-lg btn-primary mx-2 shadow"><i
                                    class="fas fa-envelope  fa-fw "></i></a>
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
                <div class="card-body">
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

    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Následující zápasy</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="list-group-flush">
                        @foreach($nextMatches as $template)
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
@endsection
