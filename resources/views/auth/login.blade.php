@extends('clean.layouts.clear')

@section('page')
        <div class="container">
            <div class="row">
                <div class="col-md-12 content">
                    <h1 class="page_tittle">Příhlášení</h1>
                    <div class="col-md-6 offset-md-3">
                        <div class="card panel-default">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    <fieldset>
                                        @csrf
                                        <div class="form-group">
                                            <input
                                                class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="uživatelské jméno" name="login" id="login" type="text"
                                                value="{{ old('username') ?: old('email') }}" required autofocus>
                                            @if ($errors->has('username') || $errors->has('email'))
                                                <span class="invalid-feedback">
                <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
            </span>
                                            @endif</div>
                                        <div class="form-group">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="heslo"
                                                   name="password" type="password" id="password" value="" required
                                                   autocomplete="password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <input type="hidden" id="remember" name="remember" value="1">
                                        <button class="btn btn-lg btn-primary btn-block" style="margin-bottom:10px;"
                                                type="submit">
                                            Přihlásit se
                                        </button>
                                    </fieldset>
                                </form>
                                <a href="/zaregistrovat" class="col-xs-12 text-center"><i class="fa fa-user-plus"
                                                                                          aria-hidden="true"></i>
                                    Registrovat se</a>&nbsp;&nbsp;&nbsp;
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="col-xs-12 text-center"><i
                                            class="fa fa-lock"
                                            aria-hidden="true"></i> Zapomenuté
                                        heslo</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
