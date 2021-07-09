@extends('clean.layouts.clear')

@section('page')
        <div class="container">
            <h1 class="page_tittle">Registrovat</h1>
            <div class="row">
                <div class="col-lg-8 offset-md-2">

                    <div class="card rounded border-0 rounded shadow-lg animated--grow-in">

                        <div class="card-body p-0">
                            <div class="p-3 p-md-4">

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="name" class="col-form-label d-none d-md-block">Uživatelské
                                                jméno</label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name"
                                                   value="{{ old('name') }}" required autocomplete="name"
                                                   placeholder="Uživatelské jméno" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label for="email"
                                                   class="col-form-label d-none d-md-block">E-mail</label>

                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ old('email') }}" required placeholder="E-mail"
                                                   autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">


                                        <div class="form-group col-12 col-md-6">
                                            <label for="password"
                                                   class="col-form-label d-none d-md-block">Heslo</label>

                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" placeholder="Heslo" required
                                                   autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label for="password-confirm"
                                                   class="col-form-label d-none d-md-block">Potvrzení hesla</label>

                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required placeholder="Potvrzení hesla"
                                                   autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="newsletter"
                                                   id="newsletter">
                                            <label class="custom-control-label mont" for="newsletter">Souhlasím se
                                                zasíláním
                                                reklamních sdělení
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" name="terms" id="terms"
                                                   required="">
                                            <label class="custom-control-label mont" for="terms">Souhlas se
                                                <a href="{{ url('./osobni-udaje.pdf') }}" target="_blank">zpracováním
                                                    osobních údajů.</a></label>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block rounded">
                                            Zaregistrovat
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="btn btn-secondary btn-block rounded" href="{{ route('login') }}">Přihlášení!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
