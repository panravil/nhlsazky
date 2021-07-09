@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
    <div class="card animated--grow-in shadow mb-4">
        <h6 class="card-header font-weight-bold text-primary py-3">
            Přidat recenze
        </h6>
        <div class="card-body">
            {!! Form::open(['url' => route('admin.recenze.store'), 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('name', 'Jméno:') }}
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Jméno']) }}
            </div>

            <div class="form-group">
                {{ Form::label('content', 'Text:') }}
                {{ Form::text('content', '', ['class' => 'form-control', 'placeholder' => 'text']) }}
            </div>
            <div class="form-group">
                {{ Form::label('rating', 'Hodnoceni:') }}
                {{ Form::number('rating', 5, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('reviewdate', 'Datum recenze') }}
                {{ Form::date('reviewdate',  \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Přidat',  ['class' => 'btn btn-primary']) }}
                <a href="{{
URL::previous()  }}" class="float-right btn btn-secondary">Zpět</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
