@inject('request', 'Illuminate\Http\Request')
@php
    $nastaveni = \App\Setting::first();
@endphp
@extends('front.layout.app')
@section('header')
    <div class="container-fluid" id="header">
        <div class="container">
            <div class="row">
                @if($request->segment(1) == '')
                    @if($nastaveni->live_chat == 1)
                        <div class="info_live_sazeni" data-aos="fade" data-aos-once="true">
                            <div class="info_live_sazeni-title"><h2>Live sázení</h2><span></span></div>
                            <a href="/live-sazky" class="info_live_button">Připojit se</a>
                            <div class="info_live_sazeni-text">Právě probíhá <span
                                    style="color: white;font-weight:bold;">LIVE SÁZENÍ</span>
                                <span class="d-none d-sm-block">, připojte se a vydělávejte s námi.</span></div>
                        </div>
                    @elseif($nastaveni->live_show == 1)
                        <div class="info_live_sazeni" data-aos="fade" data-aos-once="true">
                            <div class="info_live_sazeni-title"><h2>Live sázení</h2><span></span></div>
                            <div class="info_live_sazeni-text">{!! $nastaveni->live_text !!}</div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="row" data-aos-once="true">
                <img src="/img/header.jpg?v2" alt="" class="img-responsive  d-none d-sm-block">
                <img src="/img/header-xs.jpg?v3" alt="" class="img-responsive  d-block d-sm-none">
            </div>
        </div>
    </div>
@endsection
@section('page')
    <div class="container">
        <div class="row">
            <div class="col-md-12 content" style="padding:0;margin-top:0; background: #212121;">
                <div class="col-12 no_padding">
                    @include('front.home.parts.matches', $matches)
                </div>
                <div class="col-12 no_padding">
                    <h1 class="h1_main">Novinky z nhl.cz</h1>
                    @php
                        $pocet_novinek = 9;
                    $xml = simplexml_load_file("http://nhl.cz/rss/nhl");
                    $index = 1;
                    foreach ($xml->channel->item as $item) {
                        if ($index > $pocet_novinek) {
                            break;
                        }
                        $index++;
                        $date = $item->pubDate;
                        $link = $item->link;
                        $title = $item->title;
                        $text = $item->description;
                        $date = strtotime($date);

                        $date = StrFTime("%d. %m. %Y - %H:%M", $date);

                        $date = str_replace(". 0", ". ", $date);

                        $num = strlen($date);

                        if (substr($date, 0, 1) == "0") $date = substr($date, 1, $num);

                        echo '<a href=' . $link . ' target="_blank" rel="noreferrer" class="col-sm-6 col-md-4">
                        <div class="thumbnail" data-aos="fade-up" data-aos-once="true">';
                        if (isset($item->enclosure)) {

                            echo "<img src='" . $item->enclosure['url'] . "' class='img-responsive' alt=''>";

                        } else {

                            echo "<img src='/images/novinky/neexistuje.jpg' class='img-responsive' alt='$title'>";

                        }
                        echo '<div class="caption">
                    <div><span class="badge"><i class="fa fa-calendar"></i> ' . $date . '</span> </div>
                    <div class="post_box_nadpis">' . $title . '</div>

                            <p>
                            <p>' . substr($text,0,190). '</p></p>
                          </div>
                        </div>
                      </a>';
                    }
                    @endphp


                </div>
            </div>
            <div class="row" style="padding: 20px 0 10px 0;">
                <div class="col-12 text-center"><img class="img-responsive"
                                                        src="/images/barion-card-payment-mark-2017-500px.png"
                                                        alt="Barion payments"></div>
            </div>
        </div>
        <div class="row">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
        </div>
    </div>
@endsection
