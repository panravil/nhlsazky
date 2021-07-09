@extends('admin.layouts.app')
@section('page')
@include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

    <div class="card shadow mb-4">
            <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Upravit balíček</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.balicky.update', $data->id), 'method' => 'PATCH']) !!}
        {{ Form::hidden('action', 'edit') }}
    <div class="form-group">
        {{ Form::label('title', 'Název') }}
        {{ Form::text('title', $data->title, ['class' => 'form-control', 'placeholder' => 'Název']) }}
    </div>
   <div class="form-group">
        {{ Form::label('show', 'Zobrazit') }}
        {{ Form::checkbox('show', '1', $data->show) }}
    </div>
 <div class="form-group">
        {{ Form::label('color', 'Barva') }}
        {{ Form::select('color', ['text-white bg-primary' => 'maxi','text-white  bg-success'=>'zelená', 'text-white  bg-info'=>'modrá', 'text-white bg-warning'=>'oranžová', 'text-white bg-danger'=>'červená', 'bg-light'=>'světla', 'text-white bg-dark'=>'tmavá'], $data->color, ['class' => 'custom-select']) }}
    </div>
                                 <div class="form-group">
        {{ Form::label('price', 'Cena') }}
        {{ Form::number('price', $data->price, ['class' => 'form-control', 'placeholder' => 'Cena']) }}
    </div>
                     <div class="form-group">
        {{ Form::label('payurl', 'Platební brána') }}
        {{ Form::text('payurl', $data->payurl, ['class' => 'form-control', 'placeholder' => 'Platební brána']) }}
    </div>
                                 <div class="form-group">
        {{ Form::label('tip_count', 'Počet tipů') }}
        {{ Form::text('tip_count', $data->tip_count, ['class' => 'form-control', 'placeholder' => 'Počet tipů']) }}
    </div>
                   <div class="form-group">
        {{ Form::label('days', 'Počet dnů') }}
        {{ Form::number('days', $data->days, ['class' => 'form-control', 'placeholder' => 'Počet dnů']) }}
    </div>
                                 <div class="form-group">
        {{ Form::label('people_count', 'Fake počet lidí') }}
        {{ Form::number('people_count', $data->people_count, ['class' => 'form-control', 'placeholder' => 'Fake počet lidí']) }}
    </div>
                <div class="form-group">
                           {{ Form::label('desc', 'Popis') }}
                    <textarea class="desc" name="desc">{{ $data->desc }}</textarea>
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
    tinymce.init({
        selector:'textarea.desc',
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
