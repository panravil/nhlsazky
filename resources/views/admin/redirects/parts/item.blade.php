<div
    class="list-group-item list-group-item-action list-group-item-light d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between"
>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <a href="{{ route('admin.redirects.edit', $tarif->id) }}" class="btn btn-light btn-sm">
            <i class="fas fa-edit fa-fw text-primary"></i>
        </a>
        <form action="{{ route('admin.redirects.destroy', $tarif->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-light btn-sm" type="submit">

                <i class="fas fa-trash fa-fw text-danger"></i>
            </button>
        </form>
    </div>
    <div class="w-100 pr-2 pl-2">
        <div class="small"><span class="text-gray-600">{{ $tarif->created_at }}</span><span
                class="badge-pill badge-light">{{ $tarif->seo }}</span></div>
        <div class="font-weight-bold text-gray-800">{{ $tarif->title }}</div>
        <div class="text-gray-600">{{  $tarif->desc  }}</div>
    </div>
    <div class="w-100 pr-2 pl-2">
        <div><a href="https://solarik.dev/akce/{{ $tarif->seo }}">https://solarik.dev/akce/{{ $tarif->seo }}</a> ->
            <span>{{ $tarif->url }}</span></div>
    </div>
</div>
