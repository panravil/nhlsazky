<section class="bg-dark">
    <div class="container">

        <!-- For demo purpose -->
        <div class="row pb-5">
            <div class="col-lg-9 mx-auto text-white text-center">
                <h1 class="h2">Často kladené otázky</h1>
                <p class="lead mb-0">Neváhajete nás kontaktovat pokud zde nenajdete odpověd na vaši otázku.</p>
            </div>
        </div><!-- End -->

        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-4 col-lg-3 col-xl-2 text-center">
                <ul class="list-unstyled d-inline-flex d-md-block">
                    <li>
                        <a href="#" class="btn btn-link p-0 p-md-2"><i class="fab fa-instagram fa-fw fa-5x"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-link p-0 p-md-2"><i
                                class="fab fa-telegram-plane fa-fw fa-5x"></i></a>
                    </li>
                    <li>
                        <a href="#" class="btn btn-link p-0 p-md-2"><i class="fas fa-envelope fa-fw fa-5x"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-8 col-lg-9 col-xl-7">
                <!-- Accordion -->
                <div id="accordionExample" class="accordion shadow">
                    @foreach($faqs as $faq)
                            @include('clean.faq.parts.question', ['faq' => $faq, 'open' => $loop->first])
                    @endforeach

                </div><!-- End -->
            </div>
        </div>
    </div>
</section>
