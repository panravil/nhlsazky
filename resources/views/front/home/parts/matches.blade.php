<div class="container zapasy">
    <h4 class="d-none d-sm-block text-center">Zápasy</h4>
    <a class="d-block d-sm-none text-center" data-toggle="collapse" href="#zapasy " aria-expanded="true"
       aria-controls="zapasy"><h4>Zápasy <i class="fa fa-caret-down"></i></h4></a>
    <div id="zapasy" class="collapse">
        @foreach($matches as $match)
            @include('front.home.parts.match', $match)
        @endforeach
    </div>
</div>
