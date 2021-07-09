@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
               Texty
            </h6>
                               <div class="card-body p-0">
                <div class="list-group-flush">
                @foreach($data as $template)
                    @include('admin.texts.parts.listItmSection', $template)
                    @endforeach
</div>
              </div>
          </div>

@endsection
