@switch($sub->package->id)
    @case(1)
    <!-- Modal -->
    <div class="modal fade subExpModal" id="subExpModal_{{ $sub->package->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="card modal-content rounded shadow-lg bg-premium-gradient h-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">PREMIUM TIPY
                            </h4>
                            @if(\Carbon\Carbon::today()->diffInDays($sub->to) == 0)
                                <p class="pb-0 mb-0">Vaše členství končí: <b>DNES</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @else
                                <p class="pb-0 mb-0">Počet dnů do konce členství:
                                    <b>{{ \Carbon\Carbon::today()->diffInDays($sub->to) }}</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @endif
                        </div>
                        <div class="card-footer px-2 bg-premium-gradient">
                            <div class="btn-group d-flex" role="group" aria-label="...">
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['premium-tipy-10', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>10&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(1)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(1)->priceEUR }}&nbsp;€
                                        </div>

                                    </div>
                                </a>
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['premium-tipy-30', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>30&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(2)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(2)->priceEUR }}&nbsp;€
                                        </div>

                                    </div>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
            @break
            @case(2)

            <div class="modal fade subExpModal" id="subExpModal_{{ $sub->package->id }}" style="padding-top: 25vh"
                 tabindex="-1"
                 role="dialog">
                <div class="modal-dialog" style="max-width: 400px;" role="document">
                    <div class="card bg-mega-gradient h-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">MEGA KURZY
                            </h4>
                            @if(\Carbon\Carbon::today()->diffInDays($sub->to) == 0)
                                <p class="pb-0 mb-0">Vaše členství končí: <b>DNES</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @else
                                <p class="pb-0 mb-0">Počet dnů do konce členství:
                                    <b>{{ \Carbon\Carbon::today()->diffInDays($sub->to) }}</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @endif
                        </div>
                        <div class="card-footer px-2 bg-mega-gradient">
                            <div class="btn-group d-flex" role="group" aria-label="...">
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['mega-kurzy-10', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>10&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(3)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(3)->priceEUR }}&nbsp;€
                                        </div>

                                    </div>
                                </a>
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['mega-kurzy-30', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>30&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(4)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(4)->priceEUR }}&nbsp;€
                                        </div>
                                    </div>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
            @break
            @case(3)
            <div class="modal fade subExpModal" id="subExpModal_{{ $sub->package->id }}" style="padding-top: 25vh"
                 tabindex="-1"
                 role="dialog">
                <div class="modal-dialog" style="max-width: 400px;" role="document">
                    <div class="card bg-live-gradient h-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">LIVE SAZKY
                            </h4>
                            @if(\Carbon\Carbon::today()->diffInDays($sub->to) == 0)
                                <p class="pb-0 mb-0">Vaše členství končí: <b>DNES</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @else
                                <p class="pb-0 mb-0">Počet dnů do konce členství:
                                    <b>{{ \Carbon\Carbon::today()->diffInDays($sub->to) }}</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @endif
                        </div>
                        <div class="card-footer px-2 bg-live-gradient">
                            <div class="btn-group d-flex" role="group" aria-label="...">
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['live-sazky-10', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>10&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(5)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(5)->priceEUR }}&nbsp;€
                                        </div>

                                    </div>
                                </a>
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['live-sazky-30', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>30&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(6)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(6)->priceEUR }}&nbsp;€
                                        </div>

                                    </div>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
            @break
            @case(4)
            <div class="modal fade subExpModal" id="subExpModal_{{ $sub->package->id }}" style="padding-top: 25vh"
                 tabindex="-1"
                 role="dialog">
                <div class="modal-dialog" style="max-width: 400px;" role="document">
                    <div class="card bg-allin-gradient h-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">ALL-IN
                            </h4>
                            @if(\Carbon\Carbon::today()->diffInDays($sub->to) == 0)
                                <p class="pb-0 mb-0">Vaše členství končí: <b>DNES</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @else
                                <p class="pb-0 mb-0">Počet dnů do konce členství:
                                    <b>{{ \Carbon\Carbon::today()->diffInDays($sub->to) }}</b></p>
                                <p>Konec platnosti členství: <b>({{ $sub->to->format('d. m. Y') }})</b></p>
                            @endif
                        </div>
                        <div class="card-footer px-2 bg-allin-gradient">
                            <div class="btn-group d-flex" role="group" aria-label="...">
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['all-in-1', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>1&nbsp;DEN</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(7)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(7)->priceEUR }}&nbsp;€
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['all-in-10', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>10&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(8)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(8)->priceEUR }}&nbsp;€
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-sm" style="padding: 0 2px 0 2px;"
                                   href="{{ route('platba', ['all-in-30', 'czk']) }}">
                                    <div class="modal-tlacitko">
                                        <div>30&nbsp;DNÍ</div>
                                        <hr style="margin: 2px 15px 2px 15px; height: 1px; background-color: black">
                                        <div style="text-transform: none">{{ \App\Tariff::findOrFail(9)->priceCZK }}
                                            &nbsp;Kč
                                            | {{ \App\Tariff::findOrFail(9)->priceEUR }}&nbsp;€
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @break

@endswitch
