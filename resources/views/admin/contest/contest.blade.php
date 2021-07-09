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
                   class="nav-link {{ $request->input() == null ? 'active' : '' }} badge badge-pill badge-light">Tabulka</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.zapasy.index', ['played' => '1']) }}"
                   class="nav-link {{ $request->input('played') == '1' ? 'active' : '' }} badge badge-pill badge-light"><i
                        class="fas fa-trophy"></i> Výherci</a>
            </li>
        </ul>
        <a href="{{ route('admin.zapasy.create') }}" class="btn rounded-pill btn-primary shadow-sm"><i
                class="fas fa-check-double fa-sm text-white"></i>
            <span class="d-none d-sm-inline"> Vyhodnotit</span></a>
    </div>
    <!-- DataTales Example -->
    <div class="cards border-bottom-primary animated--grow-in shadow mb-4">
        <div class="card-header py-3">Pořadí soutěže
        </div>
        <div class="card-body p-0 pt-md-3 pb-md-1 pl-lg-4 pr-lg-4">
            <div class="table-responsive table-hover">                  <table class="table table-striped table_soutez">
                            <thead>
                            <tr>
                                <th>Pozice / Uživatel</th>
                                <th class="text-center" width="13%" title="počet tipů">T</th>
                                <th class="text-center" width="13%" title="počet uhodnutých tipů">V</th>
                                <th class="text-center" width="13%" title="počet neuhodnutých tipů">P</th>
                                <th class="text-center" width="13%">Body</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $user)
                                <tr>
                                    <td>{{ $loop->index +1 }}. <a href="/soutez/{{ $user->name }}"
                                                                  class="soutez_stats_odkaz">{{ $user->name }}</a></td>
                                    <td class="text-center">{{ $user->total }}</td>
                                    <td class="soutez_stats_vyhra text-center">{{ $user->good }}</td>
                                    <td class="soutez_stats_prohra text-center">{{ $user->bad }}</td>
                                    <td class="text-center">{{ $user->body }}</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                {{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->links() : ''}}
            </div>
        </div>
    </div>
@endsection
