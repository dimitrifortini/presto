<footer class="bg-blk text-light pt-5 pb-3 mt-5 ">
    <div class="container">

        <div class="row gy-5">

            <!-- Brand -->
            <div class="col-lg-4">
                <h2 class="fw-bold text-white mb-3 h3">
                    </i>Presto.it
                </h2>

                <p class="text-secondary">
                    {{ __('ui.footer_description') }}
                </p>

                <div class="d-flex gap-3 mt-4">

                    <a href="#" class="text-light fs-4">
                        <i class="fa-brands fa-facebook"></i>
                    </a>

                    <a href="#" class="text-light fs-4">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#" class="text-light fs-4">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>

                    <a href="#" class="text-light fs-4">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>

                </div>

            </div>


            <div class="col-6 col-md-3 col-lg-2">

                <h5 class="fw-semibold mb-3">{{ __('ui.marketplace') }}</h5>

                <ul class="list-unstyled">

                    <li class="mb-2">
                        <a href="{{ route('article.index') }}" class="text-secondary text-decoration-none">
                            {{ __('ui.all_articles') }}
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('article.create') }}" class="text-secondary text-decoration-none">
                            {{ __('ui.publish_article') }}
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="{{ route('become.revisor') }}" class="text-secondary text-decoration-none">
                            {{ __('ui.work_with_us') }}
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none">
                            {{ __('ui.how_it_works') }}
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-6 col-md-3 col-lg-2">

                <h5 class="fw-semibold mb-3">{{ __('ui.support') }}</h5>

                <ul class="list-unstyled">

                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none">
                            {{ __('ui.help_center') }}
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none">
                            {{ __('ui.contact_us') }}
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none">
                            {{ __('ui.faq') }}
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none">
                            {{ __('ui.report_problem') }}
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-md-6 col-lg-4">

                <h5 class="fw-semibold mb-3">{{ __('ui.company') }}</h5>

                <p class="text-secondary mb-2">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Via dai pascoli 1, Buonnome
                </p>

                <p class="text-secondary mb-2">
                    <i class="fa-solid fa-envelope me-2"></i>
                    info@presto.it
                </p>

                <p class="text-secondary mb-2">
                    <i class="fa-solid fa-phone me-2"></i>
                    +39 02 12345678
                </p>

                <div class="mt-4">

                    <a href="#" class="text-secondary text-decoration-none me-3">
                        {{ __('ui.privacy_policy') }}
                    </a>

                    <a href="#" class="text-secondary text-decoration-none me-3">
                        {{ __('ui.cookie_policy') }}
                    </a>

                    <a href="#" class="text-secondary text-decoration-none">
                        {{ __('ui.terms_conditions') }}

                    </a>

                </div>

            </div>

        </div>

        <hr class="border-secondary my-4">

        <div class="row align-items-center">

            <div class="col-md-6 text-center text-md-start">
                <small class="text-secondary">
                    {{ __('ui.copyright') }}

                </small>
            </div>

            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">

                <small class="text-secondary">
                    Made with
                    <i class="fa-solid fa-heart text-danger"></i>
                    in Italy
                </small>

            </div>

        </div>

    </div>
</footer>
