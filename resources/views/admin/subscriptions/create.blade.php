@extends('admin.layouts.app')
@section('page')
@include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

    <div class="card shadow mb-4">
            <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Přidat předplatné</h6>
            </div>
            <div class="card-body">
                           <div class="form-group">
        <label for="user">Uživatel</label>
        <input class="form-control" disabled name="user" type="text" value="{{ $user->email }}" id="user">
    </div>
                           <div class="form-group">
        <label for="package">Balíček</label>
        <input class="form-control" disabled name="package" type="text" value="{{ $package->title }}" id="package">
    </div>
                      {!! Form::open(['url' => route('admin.predplatne.store'), 'method' => 'POST', 'class' => '']) !!}
                        {{ Form::hidden('package_id', $package->id) }}
                    {{ Form::hidden('user_id', $user->id) }}
                 <div class="form-group">
        {{ Form::label('from', 'Od') }}
        {{ Form::text('from', \Carbon\Carbon::now()->startOfDay(), ['class' => 'form-control', 'placeholder' => 'Od']) }}
    </div>
                                 <div class="form-group">
        {{ Form::label('to', 'Do') }}
        {{ Form::text('to',  \Carbon\Carbon::now()->startOfDay()->addDays($package->days < 1 ? 9999 : $package->days), ['class' => 'form-control', 'placeholder' => 'Do']) }}
    </div>
                                                 <div class="form-group">
        {{ Form::label('price', 'Cena') }}
        {{ Form::number('price', $package->price, ['class' => 'form-control', 'placeholder' => 'Cena']) }}
    </div>
 <div class="form-group">
        {{ Form::submit('Upravit',  ['class' => 'btn btn-primary']) }}
        <a href="{{ URL::previous() }}" class="float-right btn btn-secondary">Zpět</a>
    </div>
    {!! Form::close() !!}
            </div>
    </div>

    </div>
@endsection
