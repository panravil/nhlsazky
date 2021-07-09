@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <!-- Content Row -->
          <div class="row">

@include('admin.users.parts.bannerUsersTotal')
@include('admin.users.parts.bannerUsersMonthly')
@include('admin.users.parts.bannerUsersTotal')
@include('admin.users.parts.bannerUsersMonthly')

          </div>
<!-- Page Heading -->
              <div class="d-flex align-items-center justify-content-between mb-3">
              <ul class="nav nav-pills">
  <li class="nav-item">
    <a href="{{ route('admin.uzivatele.index') }}" class="nav-link {{ $request->input() == null ? 'active' : '' }} badge badge-pill badge-light">Vše</a>
  </li>

  <li class="nav-item">
                        <a href="{{ route('admin.uzivatele.index', ['deleted' => '1']) }}" class="nav-link {{ $request->input('deleted') == '1' ? 'active' : '' }} badge badge-pill badge-light"><i class="fas fa-trash"></i> Smazané</a>
  </li>
</ul>
          </div>
          <!-- DataTales Example -->
          <div class="card border-bottom-primary animated--grow-in shadow mb-4">
            <div class="card-header py-3">
                          <form class="navbar-search">
            <div class="input-group">
              <input type="text" id="search" name="search" class="form-control bg-light border-0 small"
                     placeholder=" {!! $request->input('search') ? $request->input('search') : 'Hledat..' !!}" aria-label="Hledat" aria-describedby="basic-addon2">
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
                      <th>Name</th>
                      <th>Email</th>
                      <th class="d-none d-sm-table-cell">Datum registrace</th>
                      <th width="10px"></th>
                    </tr>
                  </thead>
                  <tbody>
                                    @foreach($data as $user)
                      <tr>
                      <td><a href="{{route('admin.uzivatele.show', $user->id)}}">{{ $user->name }}</a></td>
                      <td>{{ $user->email }}</td>
                      <td class="d-none d-sm-table-cell">{{ $user->created_at }}</td>
                      <td>


                          <div class="btn-group p-0 btn-block d-none d-md-inline-flex" role="group">
                                                  <a class="btn btn-sm btn-good" href="{{ route('admin.uzivatele.show', $user->id)}}"><i class="fas fa-info fa-fw"></i></a>
                <a class="btn btn-sm btn-great" href="{{ route('admin.uzivatele.edit', $user->id)}}"><i class="fas fa-edit fa-fw"></i></a>

                <div class="dropdown-divider"></div>
                                @if($user->trashed())
                <form action="{{ route('admin.uzivatele.update', $user->id)}}" method="post">
                  @csrf
                     <input type="hidden" name="action" value="restore">
                  @method('PATCH')
                  <button class="btn btn-sm btn-warning" type="submit"><i class="fas fa-trash-restore-alt text-white fa-fw"></i></button>
                </form>
                @else
                                  <form action="{{ route('admin.uzivatele.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit" onClick="return confirm('Opravdu smazat?!');"><i class="fas fa-trash text-white fa-fw"></i></button>
                </form>
                @endif
                          </div>
                          <div class="btn-group p-0 btn-block d-inline d-md-none" role="group">
                              <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-primary"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Možnosti:</div>
                <a class="dropdown-item" href="{{ route('admin.uzivatele.show', $user->id)}}"><i class="fas fa-info fa-fw"></i> Zobrazit</a>
                <a class="dropdown-item" href="{{ route('admin.uzivatele.edit', $user->id)}}"><i class="fas fa-edit fa-fw"></i> Upravit</a>

                <div class="dropdown-divider"></div>
                                @if($user->trashed())
                <form action="{{ route('admin.uzivatele.update', $user->id)}}" method="post">
                  @csrf
                     <input type="hidden" name="action" value="restore">
                  @method('PATCH')
                  <button class="dropdown-item" type="submit"><i class="fas fa-trash-restore-alt text-danger fa-fw"></i> Obnovit</button>
                </form>
                @else
                                  <form action="{{ route('admin.uzivatele.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="dropdown-item" type="submit"><i class="fas fa-trash text-danger fa-fw"></i> Smazat</button>
                </form>
                @endif
            </div>
        </div>
</div>
                          </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
{{ $data instanceof \Illuminate\Pagination\LengthAwarePaginator ? $data->appends(['notification' => Request::input('notification')])->appends(['hidden' => Request::input('hidden')])->links() : ''}}
              </div>
            </div>
          </div>
@endsection
