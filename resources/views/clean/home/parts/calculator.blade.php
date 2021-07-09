<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">
            <calculator-component></calculator-component>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <div id="calculator_card" class="card bg-secondary my-3 my-md-0">
                <div class="card-body">
                    <h4 class="card-title">Zjitětě kolik můžete vydělat </h4>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text lead">Zadej částku, za kterou běžně sázíš nebo chceš sázet a kalkulačka ti podle
                        historie tipů a statistik vypočte reálný zisk, který si se mnou můžeš za 30 dní průměrně
                        vydělat. </p>
                    <p style="font-weight: 200">Zisk může být samozřejmě trochu vyšší nebo nižší, záleží na úspěšnosti v
                        daném měsíci,
                        ale díky datům od roku 2014 je výsledná částka hodně přesná.</p>
                </div>
            </div>
            <div class="d-flex justify-space-between mb-3">
                <a href="{{ route('premium') }}" class="card-link btn btn-lg btn-block rounded btn-primary my-3 px-3">Stát
                    se členem</a>
                <a href="{{ route('statsGlobal') }}" class="card-link btn btn-lg rounded btn-light  my-3 ml-3">Statistiky</a>
            </div>
        </div>
    </div>
</div>
