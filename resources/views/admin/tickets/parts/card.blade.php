<!-- Dropdown Card Example -->

<!-- Card Header - Dropdown -->
<div
    class="card-header {{ $ticket->package->color }} text-white py-2 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold">{{ $ticket->package->title }}
        <small>{{ $ticket->created_at->format('d.m. H:i')  }}</small>
    </h6>
    <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Zobrazit:</div>
            <a class="dropdown-item" href="{{ route('admin.balicky.show', $ticket->package->id) }}"><i
                    class="fas fa-archive fa-fw"></i> Balíček</a>
            <div class="dropdown-divider"></div>
            <div class="dropdown-header">Akce:</div>

            <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                @csrf
                <input type="hidden" name="action" value="{!! !$ticket->show == 1 ? 'show' : 'hide' !!}">
                @method('PATCH')
                <button class="dropdown-item"
                        type="submit">{!! $ticket->show == 1 ? '<i class="fas fa-eye-slash fa-fw"></i> Schovat' : '<i class="fas fa-eye fa-fw"></i> Zobrazit'   !!}</button>
            </form>
            <a class="dropdown-item" href="{{ route('admin.tikety.edit', $ticket->id)}}"><i
                    class="fas fa-edit fa-fw"></i> Upravit</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('admin.tikety.destroy', $ticket->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="dropdown-item" type="submit"><i class="fas fa-trash text-danger fa-fw"></i> Smazat
                </button>
            </form>
        </div>
    </div>
</div>
<!-- Card Body -->
<div
    class="card-body p-1 {{ $ticket->status === 1 ? 'bg-great' :   ($ticket->status === 3 ? 'bg-warning' :  ($ticket->status === 2 ? 'bg-danger' :  ''))  }}">
    <ul class="list-group list-group-flush">
            @include('admin.tickets.parts.tip', $ticket)
    </ul>
</div>
<div class="card-footer py-0 px-1 px-md-3">
    <div class="d-flex justify-content-between align-content-end pt-1 pb-0 w-100">
        <h6 class="mb-0">Důvěra: {{ $ticket->cost }}/10</h6>
        <h6 class="mt-auto">Kurz: {{ $ticket->odds }}</h6>
    </div>
    <div class="d-flex justify-content-between align-content-end w-100">
        <h6 class="mt-auto">Vklad*: {{ $ticket->cost * 500 }} Kč</h6>
        <h6 class="mt-auto">Zisk*: {{ $ticket->profit * 1000 }} Kč</h6>
    </div>
</div>




