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
                <a href="{{ route('admin.transakce.index') }}"
                   class="nav-link {{ $request->input() == null ? 'active' : '' }} badge badge-pill badge-light">Zaplacené</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.transakce.index', ['all' => '1']) }}"
                   class="nav-link {{ $request->input('all') == '1' ? 'active' : '' }} badge badge-pill badge-light"><i
                        class="fas fa-trash"></i> Vše</a>
            </li>
        </ul>
    </div>
    <!-- DataTales Example -->
    <div class="card border-bottom-primary animated--grow-in shadow mb-4">
        <div class="card-header py-3">
            <form class="navbar-search">
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control bg-light border-0 small"
                           placeholder=" {!! $request->input('search') ? $request->input('search') : 'Hledat..' !!}"
                           aria-label="Hledat" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body p-0 pt-md-3 pb-md-1 pl-lg-4 pr-lg-4">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tarif</th>
                        <th>Uživatel</th>
                        <th class="d-none d-sm-table-cell">Aktivace</th>
                        <th width="10px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $transaction)

                        <tr>
                            <td>
                                <a class="badge badge-{{ $transaction->activated_date ? 'success': 'warning'}}"
                                   href="{{ route('admin.tarify.show', $transaction->tariff->id) }}">{{ $transaction->tariff->title }}
                                    <span>({{ $transaction->priceCZK }}Kč)</span></a>
                                {{$transaction->created_at}}
                            </td>
                            @if($transaction->user)
                                <td>
                                    <a href="{{ route('admin.uzivatele.show', $transaction->user->id) }}">{{ $transaction->user->email }}</a>
                                </td>
                            @else
                                <td>{{ $transaction->user_email }} | {{ $transaction->created_at }}</td>
                            @endif
                            <td class="d-none d-sm-table-cell">{{ $transaction->activated_to }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->links() : ''}}
            </div>
        </div>
    </div>
@endsection
