@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Přidat zápas</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.zapasy.store'), 'method' => 'POST']) !!}

                <div class="form-group">
                    {{ Form::label('start', 'Zacatek zápasu:') }}
                    {{ Form::text('start', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'Zacatek datum']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('host_team', 'Domácí') }}
                    {{ Form::select('host_team', $teams->pluck('name', 'id'), '', ['class' => 'custom-select', 'placeholder' => 'Domácí']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('guest_team', 'Hosté') }}
                    {{ Form::select('guest_team', $teams->pluck('name', 'id'), '', ['class' => 'custom-select', 'placeholder' => 'Hosté']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('week', 'Týden') }}
                    {{ Form::number('week', \Carbon\Carbon::now()->week, ['class' => 'form-controler', 'placeholder' => 'Týden']) }}
                </div>

                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" type="checkbox" value="1" name="show" id="show">
                    <label class="custom-control-label" for="show">Zobrazit</label>
                </div>

                <div class="form-group">
                    {{ Form::submit('Přidat',  ['class' => 'btn btn-primary']) }}
                    <a href="{{ URL::previous() }}" class="float-right btn btn-secondary">Zpět</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
