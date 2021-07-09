<div class="card bg-dark shadow-lg">
    <div id="heading{{$faq->id}}" class="card-header shadow-sm border-0">
        <h5 class="mb-0">
            <a href="#" type="button" data-toggle="collapse" data-target="#collapse{{$faq->id}}"
               aria-expanded="{{ $open? "true": "false" }}"
               aria-controls="collapse{{$faq->id}}"
               class="btn btn-link font-weight-bold text-uppercase collapsible-link">{{$faq->question}}
            </a>
        </h5>
    </div>
    <div id="collapse{{$faq->id}}" aria-labelledby="heading{{$faq->id}}" data-parent="#accordionExample"
         class="collapse {{ $open? "show": "" }}">
        <div class="card-body p-4">
            <p class="font-weight-light m-0">
                {{$faq->dsc}}</p>
        </div>
    </div>
</div><!-- End -->
