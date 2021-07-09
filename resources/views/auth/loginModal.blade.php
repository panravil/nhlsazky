<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content shadow-lg rounded">

            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Přihlášení</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="">
                    <div class="">
                        <form id="loginModal" method="POST" action="{{ route('login') }}">
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
                                           autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <input type="hidden" id="remember" name="remember" value="1">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer px-4 d-flex justify-content-center">
                <button class="btn btn-lg btn-primary btn-block rounded" style="margin-bottom:10px;" form="loginModal"
                        type="submit">
                    Přihlásit se
                </button>
                <div class="d-flex justify-content-center align-items-center w-100">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="btn btn-sm btn-outline-light grow rounded no-shadow"><i
                                class="fa fa-lock"
                                aria-hidden="true"></i> Zapomenuté
                            heslo</a>
                    @endif
                    <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light grow rounded no-shadow">
                        <i
                            class="fa fa-user-plus"
                            aria-hidden="true"></i> Registrovat se
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
