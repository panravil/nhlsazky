@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="my-0 font-weight-bold text-primary ">
               Blog
            </h6>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-sm rounded-pill btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white"></i>
                <span class="d-none d-sm-inline"> Přidat</span></a>
                  </div>
                 <div class="card-body p-0">
                <div class="list-group-flush">
                @foreach($data as $template)
                    @include('admin.texts.parts.listItmBlog', $template)
                    @endforeach
</div>
              </div>
          </div>

@endsection
