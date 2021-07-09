@extends('admin.layouts.app')
@section('page')
@include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Upravit tip</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.tipy.update', $tip->id), 'method' => 'PATCH']) !!}
                      <div class="form-group">
        {{ Form::hidden('ticket_id', $tip->ticket->id ) }}
        {{ Form::hidden('uri', $uri ) }}
        {{ Form::hidden('action', 'edit' ) }}
        {{ Form::label('sport_id', 'Sport') }}
        {{ Form::select('sport_id', \App\Sport::all()->pluck('name', 'id'), $tip->sport->id, ['class' => 'custom-select', 'placeholder' => 'Sport']) }}
    </div>
                <div class="form-group">
        {{ Form::label('tournament', 'Soutěž') }}
        {{ Form::text('tournament', $tip->tournament, ['class' => 'form-control', 'placeholder' => 'Soutěž']) }}
    </div>
                    <div class="form-group">
        {{ Form::label('match', 'Zápas') }}
        {{ Form::text('match', $tip->match, ['class' => 'form-control', 'placeholder' => 'Zápas']) }}
    </div>
                    <div class="form-group">
        {{ Form::label('date', 'Datum') }}
        {{ Form::text('date', $tip->date, ['class' => 'form-control', 'placeholder' => 'Datum']) }}
    </div>
                 <div class="form-group">
        {{ Form::label('tip', 'tip') }}
        {{ Form::text('tip', $tip->tip, ['class' => 'form-control', 'placeholder' => 'Tip']) }}
    </div>
                  <div class="form-group">
        {{ Form::label('odds', 'Kurz') }}
        {{ Form::number('odds', $tip->odds, ['step' => '0.01','class' => 'form-control', 'placeholder' => 'Kurz']) }}
    </div>
                <div class="form-group">
        {{ Form::label('note', 'Poznámka') }}                    <textarea class="note" name="note">{{ $tip->desc }}</textarea>
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector:'textarea.note',
        height: 300
    });
</script>
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
