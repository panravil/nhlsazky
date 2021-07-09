@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <!-- Content Row -->
    <div class="row">
    </div>

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ route('admin.redirects.create') }}" class="btn rounded-pill btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white"></i>
            <span class="d-none d-sm-inline"> Přidat</span></a>
    </div>
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card animated--grow-in shadow mb-4">
                <h6 class="card-header font-weight-bold text-primary py-3">
                    Přesměrování
                </h6>
                <div class="card-body p-0">
                    <div class="list-group-flush">
                        @foreach($data as $tarif )
                            @include('admin.redirects.parts.item', $tarif)
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
