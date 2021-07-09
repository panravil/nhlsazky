@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
    <div class="card animated--grow-in shadow mb-4">
        <h6 class="card-header font-weight-bold text-primary py-3">
            Upravit recenze {{ $template->title }}
        </h6>
        <div class="card-body">
            {!! Form::open(['url' => route('admin.recenze.update', $template->id), 'method' => 'PATCH']) !!}
            <div class="form-group">
                {{ Form::label('name', 'Jméno:') }}
                {{ Form::text('name', $template->name, ['class' => 'form-control', 'placeholder' => 'Jméno']) }}
            </div>
            <div class="form-group">
                {{ Form::label('content', 'Text:') }}
                {{ Form::text('content', $template->content, ['class' => 'form-control', 'placeholder' => 'Text']) }}
            </div>
            <div class="form-group">
                {{ Form::label('rating', 'Hodnoceni:') }}
                {{ Form::text('rating', $template->rating, ['class' => 'form-control', 'placeholder' => 'Seo']) }}
            </div>
            <div class="form-group">
                {{ Form::label('reviewdate', 'Datum recenze:') }}
                {{ Form::date('reviewdate', $template->reviewdate, ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
            </div>


            <div class="form-group">
                {{ Form::submit('Upravit',  ['class' => 'btn btn-primary']) }}
                <a href="{{
URL::previous()  }}" class="float-right btn btn-secondary">Zpět</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
