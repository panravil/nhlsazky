<section class="pt-5 pb-5 bg-secondary news">
    <div class="container">
        <div class="row d-flex">
            <div class="col-12">
                <h3 class="mb-2 text-center">Novinky z NHL</h3>
            </div>
            <div id="carousel-example-generic" class="carousel multi slide" data-ride="carousel" data-itemcount-l="4"
                 data-itemcount-m="3" data-itemcount-s="2" autostart="0">
                <div class="carousel-inner mx-1" role="listbox">

                    @php
                        $pocet_novinek = 12;
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

                        echo '
                    <div class="col-sm-6 col-md-4 col-lg-3 my-1">
                    <a href="' . $link . '" target="_blank"
                           class="card article shadow-lg rounded card-body shadow justify-content-between bg-primary text-light"
                           style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(' . route("proxy", ["url"=> $item->enclosure['url']]) . '); background-size: cover">';
                        echo '<div class="d-flex justify-content-between mb-3">
                                <div class="text-white d-flex">
                                    <div class="mr-2">
                <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class=" ">' . $date . '</span>
                                </div>
                            </div>
                            <div>
                                <div class="  text-dark mb-0">
                                    <h4 class="h4 mb-2 text-white article-title ">' . $title . '</h3>
                                </div>
                            </div>
                        </a>
                    </div>';
                    }
                    @endphp
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
            </div>
        </div>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('clean.layouts.parts.bannerlong')
                </div>
            </div>
        </div>
    <div class="skew-cc-dark-black"></div>
</section>

