<a class="list-group-item list-group-item-action {{ $tarif->show == 1 ? 'list-group-item-light' : 'list-group-item-secondary'}} d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between"
   href="{{ route('admin.tarify.edit', $tarif->id) }}">
    <div>
        <div class="icon-circle {{ $tarif->package->color }}">
            <i class="fas {{ $tarif->show == 0 ? 'fa-envelope' : 'fa-envelope-open'}} text-white"></i>
        </div>
    </div>
    <div class="w-100 pr-2 pl-2">
        <div class="small"><span class="text-gray-600">{{ $tarif->created_at }}</span><span
                class="badge-pill badge-light">{{ $tarif->package->title }}</span></div>
        <div class="font-weight-bold text-gray-800">{{ $tarif->title }}</div>
        <div class="text-gray-600">{{  $tarif->priceCZK  }}</div>
    </div>
    <div class="w-100 pr-2 pl-2">
        <span>{{ $tarif->Urlczk }}</span>
    </div>
</a>
