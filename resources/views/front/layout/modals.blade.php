<!-- Modal -->
<div class="modal fade" id="buy-1" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;" role="document">
        <div class="card modal-content rounded package_card bg-premium-gradient h-100">
            <div class="card-body">
                <h4 class="card-title text-center">PREMIUM TIPY
                </h4>
                <ul>
                    <li>Denně 1-5 tipů</li>
                    <li>Kurzy 1.50 - 2.99</li>
                    <li>Doporučené vklady</li>
                    <li>E-mail notifikace</li>
                </ul>
            </div>
            <div class="card-footer px-2 bg-premium-gradient">
                <div class="btn-group d-flex" role="group" aria-label="...">
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['premium-tipy-10', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>10&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(1)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(1)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a>
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['premium-tipy-30', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>30&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(2)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(2)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="buy-2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;" role="document">
        <div class="card modal-content rounded package_card bg-mega-gradient h-100">
            <div class="card-body">
                <h4 class="card-title text-center">MEGA KURZY
                </h4>
                <ul>
                    <li>Denně 1-3 tipů</li>
                    <li>Kurzy 3.00 - 7.00</li>
                    <li>Doporučené vklady</li>
                    <li>E-mail notifikace</li>
                </ul>
            </div>
            <div class="card-footer px-2 bg-mega-gradient">
                <div class="btn-group d-flex" role="group" aria-label="...">
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['mega-kurzy-10', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>10&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(3)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(3)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a>
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['mega-kurzy-30', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>30&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(4)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(4)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="buy-3" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;" role="document">
        <div class="card modal-content rounded package_card bg-live-gradient h-100">
            <div class="card-body">
                <h4 class="card-title text-center">LIVE SAZKY
                </h4>
                <ul>
                    <li>Vždy 3-6 tipů</li>
                    <li>Pravidelně alespoň 3x týdně</li>
                    <li>Doporučené vklady</li>
                    <li>Webové notifikace</li>
                </ul>
            </div>
            <div class="card-footer px-2 bg-live-gradient">
                <div class="btn-group d-flex" role="group" aria-label="...">
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['live-sazky-10', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>10&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(5)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(5)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a>
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['live-sazky-30', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>30&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(6)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(6)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="buy-4" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;" role="document">
        <div class="card modal-content rounded package_card bg-allin-gradient h-100">
            <div class="card-body">

                <h4 class="card-title text-center">ALL-IN
                </h4>
                <ul class="my-0 py-0">
                    <li>Premium tipy</li>
                    <li>Mega kurzy</li>
                    <li>Live sázky</li>
                    <li>Prostě všechny tipy</li>
                </ul>
            </div>
            <div class="card-footer px-2 bg-allin-gradient">
                <div class="btn-group d-flex" role="group" aria-label="...">
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['all-in-1', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>1&nbsp;DEN</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(7)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(7)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a>
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['all-in-10', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>10&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(8)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(8)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a>
                    <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                       href="{{ route('platba', ['all-in-30', 'czk']) }}">
                        <div class="modal-tlacitko">
                            <div>30&nbsp;DNÍ</div>

                            <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                            <div style="text-transform: none">{{ \App\Tariff::findOrFail(9)->priceCZK }}&nbsp;Kč
                                | {{ \App\Tariff::findOrFail(9)->priceEUR }}&nbsp;€
                            </div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
