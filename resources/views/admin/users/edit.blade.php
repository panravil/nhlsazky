@extends('admin.layouts.app')
@section('page')
@include('admin.layouts.parts.alerts')
    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

    <div class="card shadow mb-4">
            <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Upravit uživatele</h6>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('admin.uzivatele.update', $data->id), 'method' => 'PATCH']) !!}
        {{ Form::hidden('action', 'edit') }}
    <div class="form-group">
        {{ Form::label('name', 'Uživatelské jméno') }}
        {{ Form::text('name', $data->name, ['class' => 'form-control', 'placeholder' => 'LOGIN']) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', $data->email, ['class' => 'form-control', 'placeholder' => 'Email']) }}
    </div>
                                <div class="form-group">
        {{ Form::label('jmeno', 'Jméno') }}
        {{ Form::text('jmeno', $data->jmeno, ['class' => 'form-control', 'placeholder' => 'Jméno']) }}
    </div>
                <div class="form-group">
        {{ Form::label('prijmeni', 'Příjmení') }}
        {{ Form::text('prijmeni', $data->prijmeni, ['class' => 'form-control', 'placeholder' => 'Příjmení']) }}
    </div>
                <div class="form-group">
        {{ Form::label('telefon', 'Telefon') }}
        {{ Form::text('telefon', $data->telefon, ['class' => 'form-control', 'placeholder' => 'Telefon']) }}
    </div>
                    <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" type="checkbox" value="1" {{ !$data->newsletter == 1 ? '' : 'checked'  }} name="newsletter" id="newsletter">
                <label class="custom-control-label" for="newsletter">Newsletter</label>
              </div>
                    <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" type="checkbox" value="1" {{ !$data->notifications == 1 ? '' : 'checked'  }} name="notifications" id="notifications">
                <label class="custom-control-label" for="notifications">Notifikace</label>
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
