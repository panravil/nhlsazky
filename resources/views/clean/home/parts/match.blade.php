        <div class="col-6 col-sm-4 col-md-3 col-lg-2 col-xl-1 zapasek">
            <div class="hlavni_zapasy bg-zapas-{{ $match->timelabel }}">
                <div class="row zapas-info">
                    <span class="badge hlavni_zapas_{{ $match->timelabel }}" style="float: left;">{{ $match->timelabel }}</span>
                    <span class="hlavni_zapas_stred_datum">{{ $match->start->format('d.m. H:i') }}</span>
                    <a href="/stream/{{ $match->id }}" class="odkaz_hlavni_zapasy" style="float: right;"><i
                            class="fa fa-television hlavni_zapas_stred_ico_stream" aria-hidden="true"
                            style="font-size:15px;"></i></a>
                </div>
                <div class="row zapas-teams">
                    <div class="col-xs-6 col-md-4 col-sm-4 text-center">
                        <img src="/images/tymy_loga/{{ $match->host->icon }}?re" alt="{{ $match->host->name }}"
                             title="{{ $match->host->name }}" class="img-team">
                        @if($match->score_host > 0 )
                        <b class="visible-xs-inline">{{ $match->score_host }}</b>
                @endif
                    </div>
                    @if($match->score_host > 0 or $match->score_guest > 0)
                        <div class="hidden-xs col-md-4 col-sm-4 text-center">
                                            <div class="hlavni_zapas_stred_vs">{{ $match->score_host }}
                                                : {{ $match->score_guest }}</div>
                                        </div>
                    @else
                    <div class="hidden-xs col-md-4 col-sm-4 text-center">
                        <div class="hlavni_zapas_stred_vs">vs</div>
                    </div>
                @endif
                    <div class="col-xs-6 col-md-4 col-sm-4 text-center">
                        <img src="/images/tymy_loga/{{ $match->guest->icon }}?re" alt="{{ $match->guest->name }}"
                             title="{{ $match->guest->name }}" class="img-team">
                        @if($match->score_guest > 0 )
                        <b class="visible-xs-inline">{{ $match->score_guest }}</b>
                @endif
                    </div>
                </div>
            </div>
        </div>
