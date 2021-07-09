@extends('clean.layouts.clear')

@section('page')
    <section class="d-flex flex-column justify-content-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-5">
                    <h1 class="page_tittle">Změnit heslo</h1>
                    <hr class="hr-line">
                    <div class="card border-0 shadow-lg rounded">

                        <div class="card-body">
                            Než budete pokračovat, potvrďte prosím své heslo.

                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">Heslo</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Potvrďte heslo
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-sm btn-link" href="{{ route('password.request') }}">
                                                Zapomenuté heslo?
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
