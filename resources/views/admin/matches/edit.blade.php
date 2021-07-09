@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Upravit zápas</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.zapasy.update', $match->id) , 'method' => 'PATCH']) !!}
                {{ Form::hidden('action', 'edit') }}
                <div class="form-group">
                    {{ Form::label('start', 'Zacatek zápasu:') }}
                    {{ Form::text('start', $match->start, ['class' => 'form-control', 'placeholder' => 'Zacatek datum']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('host_team', 'Domácí') }}
                    {{ Form::select('host_team', $teams->pluck('name', 'id'), $match->host_team, ['class' => 'custom-select', 'placeholder' => 'Domácí']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('guest_team', 'Hosté') }}
                    {{ Form::select('guest_team', $teams->pluck('name', 'id'), $match->guest_team, ['class' => 'custom-select', 'placeholder' => 'Hosté']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('week', 'Týden') }}
                    {{ Form::number('week', $match->week, ['class' => 'form-controler', 'placeholder' => 'Týden']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('winner', 'Vítěz') }}
                    {{ Form::number('winner', $match->winner, ['class' => 'form-controler', 'placeholder' => 'Vítěz']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('score_host', 'Score domácí') }}
                    {{ Form::number('score_host', $match->score_host, ['class' => 'form-controler', 'placeholder' => 'Score']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('score_guest', 'Score hosté') }}
                    {{ Form::number('score_guest', $match->score_guest, ['class' => 'form-controler', 'placeholder' => 'Score']) }}
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
