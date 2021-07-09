@inject('request', 'Illuminate\Http\Request')
@extends('admin.emails.layouts.page')
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
               Upravit šablonu {{ $template->title }}
            </h6>
                     <div class="card-body">
                {!! Form::open(['url' => route('admin.emails.update', $template->id), 'method' => 'PATCH']) !!}
                    <div class="form-group">
        {{ Form::label('subject', 'Předmět') }}
        {{ Form::text('subject', $template->subject, ['class' => 'form-control', 'placeholder' => 'NHLsázení.cz - ..']) }}
    </div>
                <div class="form-group">
        {{ Form::label('text', 'Text') }}
                    <textarea class="text" name="text">{{ $template->html_template }}</textarea>
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
