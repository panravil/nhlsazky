

<div class="w-100 p-2 my-2 rounded @php if ($ticket->status == '1') {
        echo "vyhra";
    } elseif ($ticket->status == '2') {
        echo "prohra";
    } elseif ($ticket->status == '3') {
        echo "vracen_vklad";
    } else {
        echo "nevyhodnoceno";
    }
@endphp">
    <div><b>{{ $ticket->match_title}}</b><span class="small pull-right">{{ $ticket->match_start }}</span></div>
    <div>{{ $ticket->tip}}  <span class="pull-right">Kurz: {{ $ticket->odds }} | Vklad {{ $ticket->cost }}</span></div>
</div>
