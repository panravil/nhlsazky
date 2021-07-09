@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <!-- Content Row -->
    <div class="row">


    </div>
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="{{ route('admin.zapasy.index') }}"
                   class="nav-link {{ $request->input() == null ? 'active' : '' }} badge badge-pill badge-light">Vše</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.zapasy.index', ['played' => '1']) }}"
                   class="nav-link {{ $request->input('played') == '1' ? 'active' : '' }} badge badge-pill badge-light"><i
                        class="fas fa-trash"></i> Odehrané</a>
            </li>
        </ul>
        <a href="{{ route('admin.zapasy.create') }}" class="btn rounded-pill btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white"></i>
            <span class="d-none d-sm-inline"> Přidat</span></a>
    </div>
    <!-- DataTales Example -->
    <div class="cards border-bottom-primary animated--grow-in shadow mb-4">
        <div class="card-header py-3">Zápasy
        </div>
        <div class="card-body p-0 pt-md-3 pb-md-1 pl-lg-4 pr-lg-4">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>start</th>
                        <th>zápas</th>
                        <th>stav</th>
                        <th width="10px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $match)
                        <tr>
                            <td class=""><a href="{{route('admin.zapasy.show', $match->id)}}">{{ $match->start->format('d.m.Y H:i') }}
                                    ({{ $match->week }})</a></td>
                            <td class="d-flex justify-content-between">
                            <span class="{{ $match->winner == 1 ? 'bg-success text-white font-weight-bold' : '' }}">
                                @if($match->winner == 0)
                                <form action="{{ route('admin.zapasy.setWinner', $match->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="winner" value="1">
                                    <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-check fa-fw"></i> {{ $match->host->name }}
                                    </button>
                                </form>
                            @else
                                {{ $match->host->name }}
                            @endif</span>
                                <span class="{{ $match->winner == 2 ? 'bg-success text-white font-weight-bold' : '' }}">
                                @if($match->winner == 0)
                                <form action="{{ route('admin.zapasy.setWinner', $match->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="winner" value="2">
                                    <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-check fa-fw"></i> {{ $match->guest->name }}
                                    </button>
                                </form>
                            @else
                                {{ $match->host->name }}
                            @endif
                            </span>
                            </td>

                            <td>{{ $match->score_host }} : {{ $match->score_guest }}</td>
                            <td>


                                <div class="btn-group p-0 btn-block d-none d-md-inline-flex" role="group">
                                    <a class="btn btn-sm btn-good" href="{{ route('admin.zapasy.show', $match->id)}}"><i
                                            class="fas fa-info fa-fw"></i></a>
                                    <a class="btn btn-sm btn-great"
                                       href="{{ route('admin.zapasy.edit', $match->id)}}"><i
                                            class="fas fa-edit fa-fw"></i></a>

                                    <div class="dropdown-divider"></div>
                                    @if($match->trashed())
                                        <form action="{{ route('admin.zapasy.restore', $match->id)}}" method="patch">
                                            @csrf
                                            <input type="hidden" name="action" value="restore">
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-warning" type="submit"><i
                                                    class="fas fa-trash-restore-alt text-white fa-fw"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.zapasy.destroy', $match->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                    onClick="return confirm('Opravdu smazat?!');"><i
                                                    class="fas fa-trash text-white fa-fw"></i></button>
                                        </form>
                                    @endif
                                </div>
                                <div class="btn-group p-0 btn-block d-inline d-md-none" role="group">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                           data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                             aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Možnosti:</div>
                                            <a class="dropdown-item" href="{{ route('admin.zapasy.show', $match->id)}}"><i
                                                    class="fas fa-info fa-fw"></i> Zobrazit</a>
                                            <a class="dropdown-item" href="{{ route('admin.zapasy.edit', $match->id)}}"><i
                                                    class="fas fa-edit fa-fw"></i> Upravit</a>

                                            <div class="dropdown-divider"></div>
                                            @if($match->trashed())
                                                <form action="{{ route('admin.zapasy.update', $match->id)}}"
                                                      method="post">
                                                    @csrf
                                                    <input type="hidden" name="action" value="restore">
                                                    @method('PATCH')
                                                    <button class="dropdown-item" type="submit"><i
                                                            class="fas fa-trash-restore-alt text-danger fa-fw"></i>
                                                        Obnovit
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.zapasy.destroy', $match->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit"><i
                                                            class="fas fa-trash text-danger fa-fw"></i> Smazat
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

                {{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->appends(['played' => Request::input('played')])->links() : ''}}
            </div>
        </div>
    </div>
@endsection
