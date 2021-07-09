@extends('clean.layouts.clear')

@section('page')
    <section class="d-flex flex-column justify-content-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-5">
                    <h1 class="page_tittle">Zapomenuté heslo</h1>
                    <hr class="hr-line">
            <div class="card border-0 shadow-lg rounded">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Obnovit heslo
                                </button>
                            </div>
                    </form>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
@endsection
