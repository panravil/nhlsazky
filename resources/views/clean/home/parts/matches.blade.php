<div class="zapasy">
    <h4 class="hidden-xs text-center">Zápasy</h4>
    <a class="visible-xs text-center" data-toggle="collapse" href="#zapasy " aria-expanded="true"
       aria-controls="zapasy"><h4>Zápasy <i class="fa fa-caret-down"></i></h4></a>
    <div id="zapasy" class="collapse">
        @foreach($matches as $match)
            @include('clean.home.parts.match', $match)
        @endforeach
    </div>
</div>
