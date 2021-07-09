
<a class="list-group-item list-group-item-action d-flex align-items-center p-0 justify-content-between"
   href="{{ route('admin.zapasy.show', $template->id) }}">
    <div class="text-center rounded flex-grow-1 {{ $template->winner == 1 ? 'border-bottom-success bg-light font-weight-bold' : 'border-bottom-danger' }}">
        <img src="{{ asset('images/tymy_loga/' . $template->host->icon) }}" alt="logo" height="30px"/></div>
    <div class="text-center">{{ $template->start->format('d.m. H:i') }}</div>
    <div class="text-center rounded flex-grow-1 {{ $template->winner == 2 ? 'border-bottom-success bg-light font-weight-bold' : 'border-bottom-danger' }}">
        <img src="{{ asset('images/tymy_loga/' . $template->guest->icon) }}" alt="logo"  height="30px"/></div>
</a>
