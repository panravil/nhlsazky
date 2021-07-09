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

                    <a href="{{ route('admin.zpravy.index') }}" class="list-group-item list-group-item-action {{ $request->segment(2) == 'zpravy' && !$request->has('unread') ? 'active' : '' }}"><i class="fas fa-envelope-open-text"></i> Vše</a>
<a href="{{ route('admin.zpravy.index', ['unread' => 1]) }}" class="list-group-item list-group-item-action {{ $request->segment(2) == 'zpravy' && $request->has('unread') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Nepřečtené </a>

                    <a class="list-group-item list-group-item-action disabled {{ $request->segment(2) == 'zpravy' && $request->segment(3) == 'create' ? 'active' : '' }}"><i class="fas fa-paper-plane"></i> Odeslat</a>

                    <a  href="{{ route('admin.emails.index') }}" class="list-group-item list-group-item-action {{ $request->segment(2) == 'emails' ? 'active' : '' }}"><i class="fas fa-file"></i> Šablony</a>

                </div>
              </div>
          </div>
            </div>
        <div class="col-12 col-md-7 col-lg-8 col-xl-9">
            @yield('subpage')
          </div>
    </div>

@endsection
