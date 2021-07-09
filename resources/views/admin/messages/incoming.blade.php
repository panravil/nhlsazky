@inject('request', 'Illuminate\Http\Request')
@extends('admin.messages.layouts.page')
@section('pills')
                 <div class="d-flex align-items-center justify-content-between mb-3">

              <ul class="nav nav-pills">
  <li class="nav-item">
    <a href="{{ route('admin.zpravy.index') }}" class="nav-link {{ $request->input() == null ? 'active' : '' }} badge badge-pill badge-light">Vše</a>
  </li>
  <li class="nav-item"><a href="{{ route('admin.zpravy.index', ['unread' => '1']) }}" class="nav-link {{ $request->input('unread') == '1' ? 'active' : '' }} badge badge-pill badge-light">Nepřečtené</a>
  </li>
</ul>
          </div>
    @endsection
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
               Doručené zprávy
            </h6>
            <div class="card-body p-0">
                <div class="list-group-flush">
                @foreach($data as $zprava)
                    @include('admin.messages.parts.listItemMessage', $zprava)
                    @endforeach
</div>
              </div>
              <div class="card-footer pb-0">
{{ $data->appends(['unread' => Request::input('unread')])->onEachSide(0)->links() }}</div>
          </div>

@endsection
