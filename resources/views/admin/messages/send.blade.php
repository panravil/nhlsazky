@inject('request', 'Illuminate\Http\Request')
@extends('admin.messages.layouts.page')
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
               Poslat email
            </h6>
                     <div class="card-body">
                {!! Form::open(['url' => route('admin.zpravy.store'), 'method' => 'POST']) !!}
                         <div class="form-group">
        {{ Form::label('template', 'Šablona') }}
        {{ Form::select('template', ['info','akce'], 0, ['class' => 'custom-select']) }}
    </div>
                    <div class="form-group">
        {{ Form::label('subject', 'Předmět') }}
        {{ Form::text('subject', '', ['class' => 'form-control', 'placeholder' => 'NHLsazeni - ..']) }}
    </div>

                 <div class="form-group">
        {{ Form::label('target', 'Adresát') }}
        {{ Form::text('target', '', ['class' => 'form-control', 'placeholder' => 'pepa@novak.cz']) }}
    </div>
                <div class="form-group">
        {{ Form::label('text', 'Text') }}
                    <textarea class="text" name="text"></textarea>
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector:'textarea.text',
        height: 300
    });
</script>
    </div>

 <div class="form-group">
        {{ Form::submit('Poslat',  ['class' => 'btn btn-primary']) }}
        <a href="{{
URL::previous()  }}" class="float-right btn btn-secondary">Zpět</a>
    </div>
    {!! Form::close() !!}
            </div>
          </div>

@endsection
