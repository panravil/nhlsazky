@extends('admin.layouts.app')
@section('page')
@include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

    <div class="card shadow mb-4">
            <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Upravit tiket</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.tikety.update', $ticket->id), 'method' => 'PATCH']) !!}
        {{ Form::hidden('action', 'edit' ) }}
                 <div class="form-group">
        {{ Form::label('package_id', 'Balíček') }}
        {{ Form::select('package_id',  \App\Package::all()->pluck('title', 'id'), $ticket->package->id, ['class' => 'custom-select', 'placeholder' => 'Balíček']) }}
    </div>
                                         <div class="form-group">
        {{ Form::label('created_at', 'Tiket datum:') }}
        {{ Form::text('created_at', $ticket->created_at, ['class' => 'form-control', 'placeholder' => 'Tiket datum']) }}
    </div>

                <div class="form-group">
                    {{ Form::label('match_id', 'Zápas') }}
                    {{ Form::select('match_id', \App\Match::all()->where('start', '>', now())->pluck('full_label', 'id'), $ticket->match_id, ['class' => 'custom-select', 'placeholder' => 'Zápas']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('tip', 'tip') }}
                    {{ Form::text('tip', $ticket->tip, ['class' => 'form-control', 'placeholder' => 'Tip']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('odds', 'Kurz') }}
                    {{ Form::number('odds', $ticket->odds, ['step' => '0.01','class' => 'form-control', 'placeholder' => 'Kurz']) }}
                </div>
                 <div class="form-group">
                    {{ Form::label('cost', 'Vklad') }}
                    {{ Form::number('cost',  $ticket->cost, ['step' => '0.5','class' => 'form-control', 'placeholder' => 'Vklad']) }}
                </div>
        <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" type="checkbox" value="1" {{ !$ticket->show == 1 ? '' : 'checked'  }} name="show" id="show">
                <label class="custom-control-label" for="show">Zobrazit</label>
              </div>
                <div class="form-group">
        {{ Form::label('note', 'Poznámka') }}
                    <textarea class="note" name="note">{{ $ticket->desc }}</textarea>
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
