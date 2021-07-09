@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-5 col-xl-4">
            <div class="card animated--grow-in shadow mb-4">
                <div class="card-header">
                    <strong><i class="fas fa-user-circle"></i> {{$data->name}}</strong>
                </div>
                <div class="card-body pb-0">
                    <h5 class="text-center">{{$data->jmeno}} {{$data->prijmeni}}</h5>
                    <h5 class="text-uppercase text-center"><i class="fas fa-envelope"></i> {{$data->email}}</h5>
                    <h5 class="text-uppercase text-center"><i class="fas fa-user-plus"></i> {{$data->created_at}}</h5>
                    <h5 class="text-uppercase text-center"><i class="fas fa-user-clock"></i> {{$data->last_login_at}}
                    </h5>
                    <h5 class="text-uppercase text-center"><i
                            class="fas fa-university"></i> {{$data->subscriptions->sum('profit') }} Kč</h5>

                    <h5 class="text-uppercase text-center"><i
                            class="fas fa-piggy-bank"></i> {{$data->subscriptions->sum('priceCZK') }} Kč</h5>
                    <div class="text-uppercase text-center"><span
                            class="badge-pill {{ $data->newsletter == 1 ? 'badge-good' : 'badge-secondary' }}"><i
                                class="fas fa-envelope-open-text"></i> Newsletter</span> <span
                            class="badge-pill {{ $data->notifications == 1 ? 'badge-good' : 'badge-secondary' }}"><i
                                class="fas fa-bell"></i> Notifikace</span></div>
                </div>

                <div class="card-footer">
                    <div class="btn-group-sm d-flex" role="group">
                        <a href="{{ route('admin.uzivatele.edit', $data->id) }}" class="btn btn-sm btn-warning w-100"><i
                                class="fas fa-edit fa-fw"></i></a>
                        <a href="#history" class="btn btn-sm btn-good w-100" data-toggle="modal" data-target="#history"
                           role="button"
                           aria-expanded="true" aria-controls="history">
                            <i class="fas fa-history"></i>
                        </a>
                        <form class="w-100" action="{{ route('admin.uzivatele.destroy', $data->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100" type="submit"
                                    onClick="return confirm('Opravdu smazat?!');"><i class="fas fa-trash fa-fw"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-11 col-lg-6 col-xl-5">
            <div class="card animated--grow-in shadow mb-4">
                <a href="#platne" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="platne">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-box-open"></i> Balíčky platné</h6>
                </a>
                <div class="collapse show" id="platne">
                    <div class="card-body">
                        @foreach($data->subscriptionsValid as $sub)
                            @include('admin.users.parts.subscription', $sub)
                        @endforeach
                        @if($data->subscriptions->count() == 0)
                            <div class="text-center"><h5><i class="fas fa-sad-tear"></i> Nemá žádné platné balíčky</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card animated--grow-in shadow mb-4">
                <a href="#neplatne" class="d-block card-header py-3" data-toggle="collapse" role="button"
                   aria-expanded="true" aria-controls="neplatne">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-box"></i> Balíčky neplatné</h6>
                </a>
                <div class="collapse show" id="neplatne">
                    <div class="card-body pt-2">
                           @foreach($data->packagesRest() as $package)
                            @include('admin.users.parts.package', $package)
                            @endforeach
                           @if($data->packagesRest()->count() == 0)<div class="text-center"><h5><i class="fas fa-smile-wink"></i> Už má všechny balíčky</h5></div>
                                     @endif
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-history"></i> Historie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
@foreach($data->subscriptionsInValid as $sub)


                                             <div class="card animated--grow-in text-white {{ $sub->package->show == 0 ? 'border-left-dark' : ''}} mb-1 {{ $sub->package->color }}">
    <!-- Card Header - Dropdown -->
    <div class="card-header border-bottom-0 pb-0 d-flex flex-row align-items-center justify-content-between bg-transparent">
        <h6 class="m-0 font-weight-bold">{{ $sub->package->title }}</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body pb-0 pt-1 d-flex align-content-between justify-content-between">

            <h6 class="">Cena: <span class="float-right badge badge-light">{{ $sub->priceCZK == null ? 'ZDARMA' : $sub->priceCZK.' Kč' }}</span></h6>
            <h6 class="">Zisk: <span class="float-right badge badge-light">{{ number_format($sub->profit, 0, ' ', ' ') }} Kč</span></h6>
                @if($sub->to != null)
            <h6 class="">Od: <span class="float-right badge badge-light">{{ $sub->from->format('d. m. Y') }}</span></h6>
            <h6 class="">Do: <span class="float-right badge badge-light">{{ $sub->to->format('d. m. Y') }}</span></h6>
        @endif
    </div>
</div>

                        @endforeach
                          @if($data->subscriptions->count() == 0)<div class="text-center"><h5><i class="fas fa-sad-tear"></i> Neměl jště žádne předplatné</h5></div>
                                     @endif
                </div>
            </div>
        </div>
    </div>
@endsection
