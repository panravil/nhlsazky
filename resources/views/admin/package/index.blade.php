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
    <a href="{{ route('admin.balicky.index') }}" class="nav-link active badge badge-pill badge-light">Balíčky</a>
  </li>
  <li class="nav-item"><a href="{{ route('admin.tarify.index') }}" class="nav-link badge badge-pill badge-light">Tarify</a>
  </li>
</ul>
          </div>
    <div class="row">
                @foreach($data as $package)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
            @include('admin.package.parts.card', $package)
            </div>
        @endforeach
    </div>
@endsection
