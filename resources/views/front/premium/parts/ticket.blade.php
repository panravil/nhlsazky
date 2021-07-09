
        <example-component></example-component>
<div class="table_tikety_datum text-light"
     style="display: flex; justify-content: space-between;">{{ $ticket->created_at->format('d.m.Y  h:i') }} <span
        class="float-right text-light">{{ $ticket->package->title }}</span></div>
<div class="" data-aos="fade" data-aos-once="true">
    <table class="table table_tikety bg-dark">
        <thead>
        <tr>
            <td colspan="3" class="d-table-cell d-sm-none">Datum zápasu:
                <span>{{ $ticket->match_start->format('d.m.Y H:i') }}</span></td>
            <td class="d-none d-sm-table-cell" style="width: 35%">Zápas:</td>
            <td class="d-none d-sm-table-cell" style="width: 20%">Tip</td>
            <td class="d-none d-sm-table-cell" style="width: 10%">Kurz</td>
            <td class="d-none d-sm-table-cell" style="width: 15%">Začátek utkání</td>
            <td class="d-none d-sm-table-cell" style="width: 20%">Stav</td>
        </tr>
        </thead>
        <tbody>
        <tr class="
            @php
            if ($ticket->status == '1') {
                echo "vyhra";
            } elseif ($ticket->status == '2') {
                echo "prohra";
            } elseif ($ticket->status == '3') {
                echo "vracen_vklad";
            } else {
                echo "nevyhodnoceno";
            }
        @endphp
            ">
            <td colspan="3" style="white-space: nowrap;" class="d-table-cell d-sm-none"><span
                    style="font-weight: 400;">Zápas:</span> {{ $ticket->match }}
                <div><span style="font-weight: 400;">Tip:</span>{{ $ticket->tip }} <span style="font-weight: 400;"> / Kurz: <b>{{ $ticket->odds }}</b></span>
                </div>
            </td>
            <td class="d-none d-sm-table-cell" style="white-space: normal;">{{ $ticket->match }}</td>
            <td class="d-none d-sm-table-cell">{{ $ticket->tip }}</td>

            <td class="d-none d-sm-table-cell">{{ $ticket->odds }}</td>

            <td class="d-none d-sm-table-cell">{{ $ticket->match_start->format('d.m.Y H:i') }}</td>
            <td class="d-none d-sm-table-cell">
                @switch($ticket->status)
                    @case(1)
                    <i class="fa fa-check" aria-hidden="true" style="font-size:1.50em"></i> <span
                        class="d-none d-sm-inline">VÝHRA</span>
                    @break
                    @case(2)
                    <i class="fa fa-times" aria-hidden="true" style="font-size:1.50em"></i> <span
                        class="d-none d-sm-inline">PROHRA</span>
                    @break
                    @case(3)
                    <i class="fa fa-circle-o-notch" aria-hidden="true" style="font-size:1.50em"></i> <span
                        class="d-none d-sm-inline">VRÁCENO</span>
                    @break
                    @default()
                    <i class="fa fa-spinner" aria-hidden="true" style="font-size:1.50em"></i> <span
                        class="d-none d-sm-inline">NEVYHODNOCENO</span>
                    @break
                @endswitch
            </td>
        </tr>
        <tr class="">
            <td class="d-none d-sm-table-cell" colspan="4">Doporučený vklad: {{ $ticket->cost }}/10</td>
            <td class="d-table-cell d-sm-none" colspan="2">Doporučený vklad: {{ $ticket->cost }}/10</td>
            <td class="d-none d-sm-table-cell text-right" colspan="2">
                @if($ticket->hasVoted())
                    <div class="d-flex justify-content-between">
                        <div class="text-nowrap">
                        HODNOCENÍ:</div>
                    <div class="progress bg-danger w-100 pr-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $ticket->vote_ratio }}%;" aria-valuenow="{{ $ticket->vote_ratio }}"
                             aria-valuemin="0" aria-valuemax="100"><i
                                class="fas fa-thumbs-up"></i></div>
                    </div>
{{ $ticket->vote_ratio }}%
                    </div>
                @else
                    <div class="btn-group">
                        <a href="{{ route('upvote', $ticket->id) }}" class="btn btn-sm btn-success"><i
                                class="fas fa-thumbs-up"></i></a>
                        <a href="{{ route('downvote', $ticket->id) }}" class="btn btn-sm btn-danger"><i
                                class="fas fa-thumbs-down"></i></a>
                    </div>
                @endif
            </td>
            <td class="d-table-cell d-sm-none" style="text-align: end;">
                @if($ticket->hasVoted())
                    <div class="d-flex justify-content-between">
                        <div class="text-nowrap">
                        HODNOCENÍ:</div>
                    <div class="progress bg-danger w-100 pr-3">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $ticket->vote_ratio }}%;" aria-valuenow="{{ $ticket->vote_ratio }}"
                             aria-valuemin="0" aria-valuemax="100"><i
                                class="fas fa-thumbs-up"></i></div>
                    </div>
{{ $ticket->vote_ratio }}%
                    </div>
                @else
                    <div class="btn-group">
                        <a href="{{ route('upvote', $ticket->id) }}" class="btn btn-sm btn-success"><i
                                class="fas fa-thumbs-up"></i></a>
                        <a href="{{ route('downvote', $ticket->id) }}" class="btn btn-sm btn-danger"><i
                                class="fas fa-thumbs-down"></i></a>
                    </div>
                @endif
                @switch($ticket->status)
                    @case(1)
                    <i class="fa fa-check" aria-hidden="true" style="font-size:1.50em; color: rgb(71,153,17)"></i> <span
                        class="d-none d-sm-block">VÝHRA</span>
                    @break
                    @case(2)
                    <i class="fa fa-times" aria-hidden="true"
                       style="font-size:1.50em; color: rgba(223, 80, 65, 1);"></i> <span class="d-none d-sm-block">PROHRA</span>
                    @break
                    @case(3)
                    <i class="fa fa-circle-o-notch" aria-hidden="true" style="font-size:1.50em;"></i> <span
                        class="d-none d-sm-block">VRÁCENO</span>
                    @break
                    @default()
                    <i class="fa fa-spinner" aria-hidden="true" style="font-size:1.50em"></i> <span
                        class="d-none d-sm-block">NEVYHODNOCENO</span>
                    @break
                @endswitch
            </td>
        </tr>
        </tbody>
    </table>
</div>
