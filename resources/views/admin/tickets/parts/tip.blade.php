<div class="list-group-item  {{ $ticket->status === 1 ? 'bg-great text-white' :   ($ticket->status === 3 ? 'bg-warning text-white' :  ($ticket->status === 2 ? 'bg-danger text-white' :  '')) }} d-flex pt-2 pb-2 pl-2 pr-2 align-items-center justify-content-between">
    <div class="w-100 pr-2 pl-2">
        <div class="small badge badge-pill badge-light">{{ $ticket->match_start->format('d. m. Y H:i') }}</div>
        <div class="font-weight-bold text-wrap">{{  $ticket->match }}</div>
        <div>{{  $ticket->tip.' '.'('.$ticket->odds.')'}}
            @if($ticket->maxitip)
                <a href="https://www.maxitip.cz/cs/registrace/?c=04&utm_campaign=04&utm_medium=odkaz" class="small badge badge-pill badge-primary text-white align-self-end pt-0 pl-0 pb-0 m-0"><img src="{{ asset('images/icons/maxitip.PNG') }}" alt="Maxitip" height="16px" /> {{ $ticket->maxitip->odd }}</a>
            @endif
        </div>
    </div>
    <div>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Akce:</div>


                @if($ticket->status == 2 or $ticket->status == 0)
                    <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="win">
                        <button class="dropdown-item" type="submit"><i class="fas fa-check fa-fw"></i> Výhra</button>
                    </form>
                @endif

                @if($ticket->status != 0)
                    <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="revert">
                        <button class="dropdown-item" type="submit"><i class="fas fa-question fa-fw"></i> Nerozhodnuto
                        </button>
                    </form>

                @endif
                @if($ticket->status != 2)
                    <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="lose">
                        <button class="dropdown-item" type="submit"><i class="fas fa-times fa-fw"></i> Prohra</button>
                    </form>
                @endif
                @if($ticket->status != 3)
                    <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="action" value="storno">
                        <button class="dropdown-item" type="submit"><i class="fas fa-times fa-fw"></i> Storno</button>
                    </form>

                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.tikety.edit', $ticket->id)}}"><i class="fas fa-edit fa-fw"></i>
                    Upravit</a>
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
    <div class="mr-0">
        @if($ticket->status == 2 or $ticket->status == 0)
            <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="action" value="win">
                <button class="btn btn-sm btn-great" type="submit"><i class="fas fa-check text-white fa-fw"></i>
                </button>
            </form>
        @endif

        @if($ticket->status != 0)
            <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="action" value="revert">
                <button class="btn btn-sm btn-light" type="submit"><i class="fas fa-question text-gray-800 fa-fw"></i>
                </button>
            </form>

        @endif
        @if($ticket->status == 1 or $ticket->status == 0)
            <form action="{{ route('admin.tikety.update', $ticket->id)}}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="action" value="lose">
                <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-times text-white fa-fw"></i>
                </button>
            </form>

        @endif

    </div>
</div>

