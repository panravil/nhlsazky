<!-- Dropdown Card Example -->
<div class="card animated--grow-in {{ $sub->package->show == 0 ? 'border-left-dark' : ''}} mb-2 {{ $sub->package->color }} text-white">
    <!-- Card Header - Dropdown -->
    <div class="card-header border-bottom-0 pb-0 d-flex flex-row align-items-center justify-content-between bg-transparent">
        <h6 class="m-0 font-weight-bold">{{ $sub->package->title }}</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Zobrazit:</div>
                <a class="dropdown-item" href="{{ route('admin.balicky.show', $sub->package->id) }}"><i class="fas fa-archive fa-fw"></i> Balíček</a>
                <a class="dropdown-item" href="{{ route('admin.tikety.index', ['package' => $sub->package->id]) }}"><i class="fas fa-clipboard-list fa-fw"></i> Tikety</a>
                <a class="dropdown-item" href="{{ route('admin.uzivatele.index', ['package' => $sub->package->id])}}"><i class="fas fa-users fa-fw"></i> Lidi</a>
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body pb-0">
            <h6 class="">Cena: <span class="float-right badge badge-light">{{ $sub->priceCZK == null ? 'ZDARMA' : $sub->priceCZK.' Kč' }}</span></h6>
            <h6 class="">Zisk: <span class="float-right badge badge-light">{{ number_format($sub->profit, 0, ' ', ' ') }} Kč</span></h6>
        @if($sub->to != null)
            <h6 class="">Končí: <span class="float-right badge badge-light">{{ $sub->to->format('d. m. Y') }}</span></h6>
        @endif
    </div>
    <div class="card-footer border-top-0 pt-0 bg-transparent">
                        <div class="btn-group d-flex justify-content-between" role="group" >
                            @if(in_array($sub->package->id, $data->subscriptionsIds()))
<div class="btn-group">
                            <a class="btn btn-light rounded-pill btn-sm" href="{{ route("admin.predplatne.edit", $sub->id) }}"><i class="fas fa-clock"></i></a>
       </div>
        {!! Form::open(['url' => route('admin.predplatne.destroy',  $sub->id), 'method' => 'DELETE', 'class' => '']) !!}
        {{ Form::hidden('package_id', $sub->package->id) }}
        {{ Form::hidden('user_id', $data->id) }}
                            <button class="btn btn-danger rounded-pill btn-sm"  type="submit"><i class="fas fa-times-circle"></i> Ukončit</button>
                            {!! Form::close() !!}
             @endif
                            </div>
                    </div>
</div>
