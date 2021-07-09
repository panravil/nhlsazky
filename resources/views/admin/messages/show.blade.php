@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 p-ml-3 p-mr-3 col-lg-8 col-xl-8">
            <!-- Dropdown Card Example -->
            <div class="card animated--grow-in shadow mb-4">
                <h6 class="card-header font-weight-bold text-primary">{{ 'Kontaktní formulář'}}</h6>
                <div class="card-body">
                    <div>{{ $contact->email }}</div>
                    <p>{{$contact->text}}</p>
                </div>
                <div class="card-footer d-flex justify-content-between align-content-between">
                    <div class="">{{ $contact->created_at->format('d. m. Y - H:i') }}</div>
                    <div class="btn-group" role="group">

                            <a class="btn btn-sm btn-primary disabled"
                               href="#"><i
                                    class="fas fa-paper-plane fa-fw"></i> Odpovědět</a>
                        @if($contact->user)
                            <a class="btn btn-sm btn-primary"
                               href="{{ route('admin.uzivatele.show', $contact->user->id)}}"><i
                                    class="fas fa-user fa-fw"></i> Uživatel</a>
                        @endif
                        @if($contact->read == 0)
                            <form action="{{ route('admin.zpravy.update', $contact->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="read">
                                @method('PATCH')
                                <button class="btn btn-sm btn-good" type="submit"><i class="fas fa-eye fa-fw"></i>Přečteno
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.zpravy.update', $contact->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="unread">
                                @method('PATCH')
                                <button class="btn btn-sm btn-good" type="submit"><i class="fas fa-eye-slash fa-fw"></i>Nepřečteno
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.zpravy.destroy', $contact->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"><i
                                    class="fas fa-trash text-white fa-fw"></i> Smazat
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
