@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 p-ml-3 p-mr-3 col-lg-8 col-xl-8">
            <!-- Dropdown Card Example -->
              <div class="card animated--grow-in shadow mb-4">
                @include('admin.ticket.parts.card', $ticket)
              </div>
            </div>
    </div>
@endsection