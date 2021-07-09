@inject('request', 'Illuminate\Http\Request')
@extends('admin.texts.layouts.page')
@section('subpage')
    <div class="card animated--grow-in shadow mb-4">
        <h6 class="card-header font-weight-bold text-primary py-3">
            Upravit událost {{ $template->title }}
        </h6>
        <div class="card-body">
            {!! Form::open(['url' => route('admin.udalosti.update', $template->id), 'method' => 'PATCH']) !!}
            <div class="form-group">
                {{ Form::label('title', 'Název:') }}
                {{ Form::text('title', $template->title, ['class' => 'form-control', 'placeholder' => 'Název']) }}
            </div>

            <div class="form-group">
                {{ Form::label('seo', 'Seo:') }}
                {{ Form::text('seo', $template->seo, ['class' => 'form-control', 'placeholder' => 'Seo']) }}
            </div>
            <div class="form-group">
                {{ Form::label('from', 'Aktivní (Od):') }}
                {{ Form::text('from', $template->from, ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
            </div>

            <div class="form-group">
                {{ Form::label('to', 'Aktivní (Do):') }}
                {{ Form::text('to', $template->to, ['class' => 'form-control', 'placeholder' => \Carbon\Carbon::now()]) }}
            </div>

            <div class="form-group">
                {{ Form::label('tariff_id', 'Tarif') }}
                {{ Form::select('tariff_id',  \App\Tariff::all()->pluck('title', 'id'), $template->tariff_id, ['class' => 'custom-select', 'placeholder' => 'Tarif']) }}
            </div>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" type="checkbox" value="1" name="show"
                       id="show" {{ $template->show ? 'checked': '' }}>
                <label class="custom-control-label" for="show">Aktivní</label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" type="checkbox" value="1" name="show_menu"
                       id="show_menu" {{ $template->show_menu ? 'checked': '' }}>
                <label class="custom-control-label" for="show_menu">Zobrazit v menu</label>
            </div>
            <div class="form-group">
                {{ Form::label('text', 'Text') }}
                <textarea class="text" name="text">{{ $template->html_template }}</textarea>
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
