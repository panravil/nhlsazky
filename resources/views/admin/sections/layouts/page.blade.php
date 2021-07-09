@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                  <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
                <i class="fas fa-bars"></i> Menu
            </h6>
            <div class="card-body p-0">
                             <div class="list-group-flush">
                @foreach($data as $template)
                    @include('admin.sections.parts.listItm', $template)
                    @endforeach
                </div>
              </div>
          </div>
            </div>
        <div class="col-12 col-md-7 col-lg-8 col-xl-9">
            @yield('subpage')
          </div>
    </div>

@endsection
