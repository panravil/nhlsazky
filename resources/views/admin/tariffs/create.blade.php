@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Přidat tarif</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.tarify.store'), 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('title', 'Název') }}
                    {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Název']) }}
                </div>
             <div class="form-group">
                    {{ Form::label('seo', 'Seo') }}
                    {{ Form::text('seo', '', ['class' => 'form-control', 'placeholder' => 'Seo']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('package_id', 'Balíček') }}
                    {{ Form::select('package_id', \App\Package::all()->pluck('title', 'id'), '', ['class' => 'custom-select', 'placeholder' => 'Balíček']) }}
                </div>
                 <div class="form-group">
                    {{ Form::label('start', 'Aktivni od:') }}
                    {{ Form::text('start', '', ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
                </div>
                 <div class="form-group">
                    {{ Form::label('end', 'Aktivni do:') }}
                    {{ Form::text('end', '', ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('show', 'Zobrazit') }}
                    {{ Form::checkbox('show', '1', true ) }}
                </div>

                <div class="form-group">
                    {{ Form::label('priceCZK', 'Cena') }}
                    {{ Form::number('priceCZK', '', ['class' => 'form-control', 'placeholder' => 'Cena CZK']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('priceEUR', 'Cena') }}
                    {{ Form::number('priceEUR', '', ['class' => 'form-control', 'placeholder' => 'Cena EUR']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('days', 'Delká členství:') }}
                    {{ Form::number('days', '', ['class' => 'form-control', 'placeholder' => 'Počet dnů']) }}
                </div>
                             <div class="form-group">
                    {{ Form::label('to', 'Členství do:') }}
                    {{ Form::text('to', '', ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('desc', 'Popis') }}
                    <textarea class="desc" name="desc"></textarea>
                    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
                    <script>
                        tinymce.init({
                            selector: 'textarea.desc',
                            height: 300
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
