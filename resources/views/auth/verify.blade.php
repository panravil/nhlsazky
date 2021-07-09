@extends('front.layout.clear')

@section('page')
    <div class="container">
    <div class="row">
        <div class="col-md-12 content" style="padding:0 10px 30px 10px;">

  <h1 class="page_tittle">Můj účet</h1>

<div class="col-md-6 offset-md-3">
                     <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 35%">MOJE ID:</th>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->id }}</td>
                                </tr>
                                <tr>
                                    <th>Uživatelské jméno:</th>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2"><a href="{{ route('accountEdit') }}" class="btn btn-sm btn-block tlacitko_live_nastaveni text-white">UPRAVIT EMAIL</a></th></tr>
                                <tr>
                                    <th>Registrovan:</th>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <div class="card-body mt-3">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Nový verifikační email byl odeslán na vaši emailovou adresu.
                    <p>Prosím zkontrolujte svou emailovou schránku včetně složby spam.<br> Verifikační email by měl být doručen do 5 minut od registrace.</p>
                        </div>

                    @else

                    <p>Prosím zkontrolujte svou emailovou schránku včetně složby spam.<br> Verifikační email by měl být doručen do 5 minut od registrace.</p>
                        <p>Pokud vám verifikační email nedošel kliknětě na následující tlačítko.</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-block btn-primary mt-3 m-0 align-baseline">Odeslat nový verifikační email</button>.
                    </form>
                        @endif
                </div>
            </div>
          </div>

    </div>
</div>

@endsection

