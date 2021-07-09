@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
    <div class="card animated--grow-in shadow mb-4">
        <h6 class="card-header font-weight-bold text-primary py-3">
            Upravit otázku
        </h6>
        <div class="card-body">
            {!! Form::open(['url' => route('admin.faq.update', $template->id), 'method' => 'PATCH']) !!}
            <input type="hidden" name="action" value="edit">
            <div class="form-group">
                {{ Form::label('question', 'Otázka') }}
                {{ Form::text('question', $template->question, ['class' => 'form-control', 'placeholder' => 'Otázka']) }}
            </div>
            <div class="form-group">
                {{ Form::label('dsc', 'Odpoved') }}
                {{ Form::text('dsc',  $template->dsc, ['class' => 'form-control', 'placeholder' => 'Odpoved']) }}
            </div>
            <div class="form-group">
                {{ Form::label('answer', 'Odpoved na celou stranku:') }}
                <textarea class="text" name="answer">{{ $template->answer }}</textarea>

            </div>

            <div class="form-group">
                {{ Form::submit('Upravit',  ['class' => 'btn btn-warning']) }}
                <a href="{{
URL::previous()  }}" class="float-right btn btn-secondary">Zpět</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
