@extends('admin.layouts.app')
@section('page')
    @include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Přidat tarif</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.redirects.update', $template->id), 'method' => 'PATCH']) !!}
                <div class="form-group">
                    {{ Form::label('title', 'Název') }}
                    {{ Form::text('title', $template->title, ['class' => 'form-control', 'placeholder' => 'Název']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('seo', 'Seo') }}
                    {{ Form::text('seo', $template->seo, ['class' => 'form-control', 'placeholder' => 'Seo']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('desc', 'desc') }}
                    {{ Form::text('desc', $template->desc, ['class' => 'form-control', 'placeholder' => 'Seo']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('img', 'img') }}
                    {{ Form::text('img', $template->img, ['class' => 'form-control', 'placeholder' => 'Seo']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('url', 'URL') }}
                    {{ Form::text('url', $template->url, ['class' => 'form-control', 'placeholder' => 'Seo']) }}
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
