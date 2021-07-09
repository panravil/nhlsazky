@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3 d-flex justify-content-between align-items-center">
               <span><i class="fas fa-fw fa-question"></i>FAQ</span><a href="{{ route('admin.faq.create') }}" class="btn rounded-pill btn-primary shadow-sm mr-0"><i class="fas fa-plus fa-sm text-white"></i>
                <span class="d-none d-sm-inline"> Přidat</span></a>
            </h6>

            <div class="card-body p-0">
                <div class="list-group-flush">
                @foreach($data as $template)
                    @include('admin.texts.parts.listItmFAQ', $template)
                    @endforeach
</div>
              </div>
          </div>

@endsection
