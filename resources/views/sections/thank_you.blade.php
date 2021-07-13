<section class="n-section n-section--how mb-6">
    <div class="container pt-5">
        <div class="row align-items-center">
            <div class="col-lg-4 text-center text-lg-left order-2 order-lg-1">
                <h4 class="display-4 mb-3 mb-lg-5">{{ widget('thank-you', 'general.title') }}</h4>
                <p class="n-lead text-center text-lg-left">
                    {!! widget('thank-you', 'general.description') !!}
                </p>
            </div>
            <div class="col-lg-7 offset-lg-1">
                @include('components.scene', ['src' => '/img/thank-you.png', 'name' => 'heart'])
            </div>
        </div>
    </div>
</section>