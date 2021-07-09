<!-- Dropdown Card Example -->
<div
    class="card animated--grow-in shadow mb-2 {{ $tarif->color }} text-white">
    <!-- Card Header - Dropdown -->
    <div class="card-header border-bottom-0 pb-0 d-flex flex-row align-items-center justify-content-between bg-transparent">
        <a href="{{ route('admin.balicky.show', $tarif->id) }}" class="text-white"><h6
                class="m-0 font-weight-bold">{{ $tarif->title }}</h6>
        </a>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <hr class="bg-light">
            <h6 class="">Cena: <span class="float-right badge badge-light">{{$tarif->priceCZK }} Kč</span></h6>
            <h6 class="">Cena: <span class="float-right badge badge-light">{{$tarif->priceEUR }} Kč</span></h6>
        <hr class="bg-light">

        <div
            class="badge badge-pill badge-light">{!! $tarif->show == 1 ? '<i class="fas fa-eye fa-fw"></i>' : '<i class="fas fa-eye-slash fa-fw"></i>'   !!}</div>

    <!-- Card Content - Collapse -->
        <div class="collapse" id="collapse_{{ $tarif->id }}">
            <small class="card-text">{{$tarif->desc}}</small>
        </div>
    </div>
</div>

