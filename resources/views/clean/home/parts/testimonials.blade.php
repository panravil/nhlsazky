<section class="pt-5 pb-5 testimonials">
    <div class="container pb-4">
        <div class="row">
            <br/>
            <div class="col text-center">
                <h2>Reference</h2>
                <p>Od roku 2014 využilo tento projekt přes <b>10 000</b> členů.</p>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 my-1 py-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex flex-row justify-space-between">{{ $reviews[0]->name }}
                            <div class="ml-auto rating">
                                @for ($i = 0; $i < 5; $i++)
                                    @if($i < $reviews[0]->rating)
                                <span>
                                    <i class="fas fa-hockey-puck text-primary"></i>
                                </span>
                                    @else
                                <span>
                                    <i class="fas fa-hockey-puck text-light"></i>
                                </span>
                                    @endif
                                @endfor
                            </div>
                        </h4>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $reviews[0]->reviewdate->format('d. m. Y') }}</h6>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">{{ $reviews[0]->content }}</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 my-1">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title d-flex flex-row justify-space-between">{{ $reviews[1]->name }}
                            <div class="ml-auto rating">
                                @for ($i = 0; $i < 5; $i++)
                                    @if($i < $reviews[1]->rating)
                                <span>
                                    <i class="fas fa-hockey-puck text-primary"></i>
                                </span>
                                    @else
                                <span>
                                    <i class="fas fa-hockey-puck text-light"></i>
                                </span>
                                    @endif
                                @endfor
                            </div>
                        </h4>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $reviews[1]->reviewdate->format('d. m. Y') }}</h6>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">{{ $reviews[1]->content }}</p>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 d-md-none d-lg-block col-lg-4 my-1 py-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex flex-row justify-space-between">{{ $reviews[2]->name }}
                            <div class="ml-auto rating">
                                @for ($i = 0; $i < 5; $i++)
                                    @if($i < $reviews[2]->rating)
                                <span>
                                    <i class="fas fa-hockey-puck text-primary"></i>
                                </span>
                                    @else
                                <span>
                                    <i class="fas fa-hockey-puck text-light"></i>
                                </span>
                                    @endif
                                @endfor
                            </div>
                        </h4>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $reviews[2]->reviewdate->format('d. m. Y') }}</h6>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">{{ $reviews[2]->content }}</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

