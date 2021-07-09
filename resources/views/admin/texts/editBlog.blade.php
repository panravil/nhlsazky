@inject('request', 'Illuminate\Http\Request')
@extends('admin.sections.layouts.page')
@section('subpage')
          <div class="card animated--grow-in shadow mb-4">
            <h6 class="card-header font-weight-bold text-primary py-3">
               Upravit blog {{ $template->title }}
            </h6>
                     <div class="card-body">
                {!! Form::open(['url' => route('admin.texty.update', $template->id), 'method' => 'PATCH']) !!}
                <div class="form-group">
        {{ Form::label('text', 'Text') }}
                    <textarea class="text" name="text">{{ $template->html_template }}</textarea>
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector:'textarea.text',
        height: 500
    });
</script>
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
