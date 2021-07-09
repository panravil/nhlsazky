<footer class="footer shadow-lg" style="margin-top: auto">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-10 h-100 text-center text-md-left my-auto">
                <div class="mb-2 mb-lg-0 text-white"><b>{{ env('APP_NAME') }}</b>&nbsp;©&nbsp;2020 <span class="small"></span>.
                </div>
                <a href="{{ route('terms') }}" style="text-decoration: underline">Ochrana osobních údajů</a> | <a href="{{ route('terms') }}" style="text-decoration: underline">Obchodní podmínky</a>
            </div>
            <div class="col-md-2 col-lg-2 h-100 text-center text-md-right">
                <a href="#" class="social">
                    <i class="fab fa-telegram-plane fa-fw"></i>
                </a>
                <a href="#" class="social">
                    <i class="fab fa-instagram fa-fw"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
