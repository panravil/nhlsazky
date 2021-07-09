<tr class="{{ $ticket->stav }}">
    <td class="d-none d-md-table-cell">{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
    <td>{{  $ticket->match }}
        <div class="d-table-cell d-sm-none">{{$ticket->tip}}</div>
        <div class="d-table-cell d-sm-none">{{$ticket->created_at->format('d.m.Y H:i')}} | Kurz: {{ $ticket->odds }} |
            Vklad: {{ $ticket->cost }} /10
        </div>
    </td>
    <td class="d-none d-md-table-cell">{{$ticket->tip}}</td>
    <td class="d-none d-md-table-cell">{{ $ticket->odds }}</td>
    <td class="d-none d-md-table-cell">{{ $ticket->cost }}/10</td>
    <td class="text-uppercase">{{ $ticket->package->title }}</td>
</tr>
