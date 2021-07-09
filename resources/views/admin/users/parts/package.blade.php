<!-- Dropdown Card Example -->
<div class="card animated--grow-in {{ $package->show == 0 ? 'border-left-dark' : ''}} mb-2 {{ $package->color }} text-white">
    <!-- Card Header - Dropdown -->
    <div class="card-header border-bottom-0 pb-0 d-flex flex-row align-items-center justify-content-between bg-transparent">
        <h6 class="m-0 font-weight-bold">{{ $package->title }}</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Zobrazit:</div>
                <a class="dropdown-item" href="{{ route('admin.balicky.show', $package->id) }}"><i class="fas fa-archive fa-fw"></i> Balíček</a>
                <a class="dropdown-item" href="{{ route('admin.tikety.index', ['package' => $package->id])}}"><i class="fas fa-clipboard-list fa-fw"></i> Tikety</a>
                <a class="dropdown-item" href="{{ route('admin.uzivatele.index', ['package' => $package->id])}}"><i class="fas fa-users fa-fw"></i> Lidi</a>
            </div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body pb-0">
    </div>
    <div class="card-footer border-top-0 pt-0 bg-transparent">
                        <div class=" btn-group-sm d-flex justify-content-between" role="group" >
<div class="btn-group">
    @foreach($package->activeTariffs as $tarif)
        {!! Form::open(['url' => route('admin.predplatne.store'), 'method' => 'POST', 'class' => '']) !!}
        {{ Form::hidden('package_id', $package->id) }}
        {{ Form::hidden('user_id', $data->id) }}
        {{ Form::hidden('tarif_id', $tarif->id) }}
                            <button class="btn btn-light rounded-pill btn-sm w-100" type="submit"><i class="fas fa-plus"></i> {{ $tarif->ShortName }}</button>
                            {!! Form::close() !!}
        @endforeach
    </div>
                            <a class="btn btn-light rounded-pill btn-sm" href="{{ route("admin.predplatne.create", ["package_id" => $package->id, "user_id" => $data->id]) }}"><i class="fas fa-clock"></i></a>
                            </div>
                    </div>
</div>
