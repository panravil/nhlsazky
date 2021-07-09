@inject('request', 'Illuminate\Http\Request')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item active text-uppercase " aria-current="page">
      {!! $request->segment(2) == '' ? '<i class="fas fa-home "></i>' : '<a href="/admin"><i class="fas fa-home"></i></a>' !!}
    </li>
    @if($request->segment(2) != '')
    <li class="breadcrumb-item active text-uppercase " aria-current="page">
      {!! $request->segment(3) == '' ? '<span class="text-uppercase">'.$request->segment(2).'</span>' : '<a href="/admin/'.$request->segment(2).'"><span class="text-uppercase">'.$request->segment(2).'</span></a>' !!}
    </li>
    @endif
  </ol>
</nav>