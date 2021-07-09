@extends('clean.layouts.app')
@section('title')
    Premium tipy | NHL Sázení
@endsection
@section('page')
    <div class="container">
        <div class="row">
            <div class="col-md-12 content"  >
                <h1 class='page_tittle'>Stream</h1>
                <div class='row' style='text-align:center'>
                    <div class="col-4">
                        <div class="stream_nazev_tym">{{ $match->host->name }}</div>
                        <div><img src="/images/tymy_loga/{{ $match->host->icon }}" width="100" height="100"
                                  alt="{{ $match->host->name }}"></div>
                    </div>
                    <div class="col-4">
                        <div class="stream_stred_datum">{{ $match->start->format('d.m.Y H:i') }}</div>
                        <div class="stream_stred_vs">vs</div>
                    </div>
                    <div class="col-4">
                        <div class="stream_nazev_tym">{{ $match->guest->name }}</div>
                        <div><img src="/images/tymy_loga/{{ $match->guest->icon }}" width="100" height="100"
                                  alt="{{ $match->guest->name }}"></div>
                    </div>
                    <div class="row"></div>
                    <style>
                        @media (max-width: 700px) {
                            .wrapper {
                                text-align: center;
                                overflow: hidden;
                            }

                            iframe {
                                transform-origin: 25vw 20px;
                                transform: scale(0.5);
                            }
                        }
                        @media (max-width: 320px) {
                            iframe {
                                transform-origin: 5vw 20px;
                                transform: scale(0.5);
                            }
                        }
                    </style>
                    <div class="wrapper">
                        <iframe id="stream" src="https://nhl-stream.com/iframe.php?page={{ $match->stream_url }}"
                                frameborder="0"
                                marginwidth="0" marginheight="0" scrolling="no" align="center" style="max-width: 640px"
                                width="640px"
                                height="550px" allowfullscreen="true"></iframe>
                    </div>
                    <br><span class='stream_info'>Stream není hostován serverem nhlsazeni.cz. Tato stránka není odpovědná za zákonnost obsahu.</span>
                </div>
            </div>
        </div>
    </div>
@endsection
