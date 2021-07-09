@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-5 col-xl-4">
            <div class="card animated--grow-in shadow mb-4">
                <div class="card-header">
                    <strong><i class="fas fa-user-circle"></i> {{$data->start}}</strong>
                </div>
                <div class="card-body pb-0 d-flex justify-content-around">
                    <div
                        class="text-center rounded flex-grow-1 {{ $data->winner == 1 ? 'border-bottom-success bg-light font-weight-bold' : 'border-bottom-danger' }}">
                        <img src="{{ asset('images/tymy_loga/' . $data->host->icon) }}" alt="logo"/><h5
                            class="text-center">{{$data->host->name }}</h5>
                        <h1 class="text-center">{{$data->score_host }}</h1>
                    @if($data->winner == 0)

                    <form action="{{ route('admin.zapasy.setWinner', $data->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="winner" value="1">
                        <button class="dropdown-item" type="submit"><i class="fas fa-check fa-fw"></i> Výhra</button>
                    </form>
                        @endif
                    </div>
                    <div
                        class="text-center rounded flex-grow-1 {{ $data->winner == 2 ? 'border-bottom-success bg-light font-weight-bold' : 'border-bottom-danger' }}">
                        <img src="{{ asset('images/tymy_loga/' . $data->guest->icon) }}" alt="logo"/><h5
                            class="text-center">{{$data->guest->name}}</h5>
                        <h1 class="text-center">{{$data->score_guest }}</h1>
                    @if($data->winner == 0)

                    <form action="{{ route('admin.zapasy.setWinner', $data->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="winner" value="2">
                        <button class="dropdown-item" type="submit"><i class="fas fa-check fa-fw"></i> Výhra</button>
                    </form>
                        @endif</div>

                </div>

                <div class="card-footer">
                    <div class="btn-group-sm d-flex" role="group">
                        <a href="{{ route('admin.zapasy.edit', $data->id) }}" class="btn btn-sm btn-warning w-100"><i
                                class="fas fa-edit fa-fw"></i></a>
                        <a href="#history" class="btn btn-sm btn-good w-100" data-toggle="modal" data-target="#history"
                           role="button"
                           aria-expanded="true" aria-controls="history">
                            <i class="fas fa-history"></i>
                        </a>
                        <form class="w-100" action="{{ route('admin.zapasy.destroy', $data->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100" type="submit"
                                    onClick="return confirm('Opravdu smazat?!');"><i class="fas fa-trash fa-fw"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="card animated--grow-in shadow mb-4">
                <a href="#tikety" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="tikety">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-box-open"></i> Tikety</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="tikety">
                    <div class="card-body">
                        <div class="list-group-flush">
                            @foreach($data->tickets as $ticket)
                                @include('admin.tickets.parts.card', $ticket)
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-12 col-sm-12 col-md-11 col-lg-6 col-xl-5">

            <div class="card animated--grow-in shadow mb-4">
                <a href="#platne" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="platne">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-box-open"></i> Poslední vzájemné
                        zápasy</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="platne">
                    <div class="card-body">
                        <div class="list-group-flush">
                            @foreach($cross as $template)
                                @include('admin.matches.parts.match', $template)
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="card animated--grow-in shadow mb-4">
                <a href="#neplatne" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="neplatne">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-box"></i> Poslední zápasy</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="neplatne">
                    <div class="card-body pt-2 d-flex justify-content-between">
                        <div class="list-group-flush flex-grow-1">
                            <div class="list-group-item text-center"><h4>{{ $data->host->name }}</h4></div>
                            @foreach($last_host as $template)
                                @include('admin.matches.parts.match', $template)
                            @endforeach
                        </div>
                        <div class="list-group-flush flex-grow-1">
                            <div class="list-group-item text-center"><h4>{{ $data->guest->name }}</h4></div>
                            @foreach($last_guest as $template)
                                @include('admin.matches.parts.match', $template)
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-history"></i> Historie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection
