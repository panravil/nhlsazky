@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Přidat tiket</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.tikety.store'), 'method' => 'POST']) !!}

                <div class="form-group">
                    {{ Form::label('created_at', 'Tiket datum:') }}
                    {{ Form::text('created_at', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'Tiket datum']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('package_id', 'Balíček') }}
                    {{ Form::select('package_id', \App\Package::all()->pluck('title', 'id'), '', ['class' => 'custom-select', 'placeholder' => 'Balíček']) }}
                </div>

                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" type="checkbox" value="1" name="show" id="show">
                    <label class="custom-control-label" for="show">Zobrazit</label>
                </div>
                <div class="form-group">
                    {{ Form::label('match_id', 'Zápas') }}
                    {{ Form::select('match_id', \App\Match::all()->where('start', '>', now())->where('start', '<', now()->addDays(1))->pluck('full_label', 'id'), '', ['class' => 'custom-select', 'placeholder' => 'Zápas']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('tip', 'tip') }}
                    {{ Form::text('tip', '', ['class' => 'form-control', 'placeholder' => 'Tip']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('odds', 'Kurz') }}
                    {{ Form::number('odds', '', ['step' => '0.01','class' => 'form-control', 'placeholder' => 'Kurz']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('cost', 'Vklad') }}
                    {{ Form::number('cost', 5, ['step' => '0.5','class' => 'form-control', 'placeholder' => 'Vklad']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('note', 'Poznamka') }}
                    <textarea class="note" name="note"></textarea>
                    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                    <script>
                        tinymce.init({
                            selector: 'textarea.note',
                            height: 300,
                        });
                    </script>
                </div>

                <div class="form-group">
                    {{ Form::submit('Přidat',  ['class' => 'btn btn-primary']) }}
                    <a href="{{ URL::previous() }}" class="float-right btn btn-secondary">Zpět</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
