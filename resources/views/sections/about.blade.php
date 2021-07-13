<section class="n-section n-section--about" id="about">
    <h6 class="n-section-title">{{ widget('welcome', 'about-us.name') }}</h6>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 col-lg-4 offset-lg-4">
                <h4 class="display-4">{!! widget('welcome', 'about-us.title') !!}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <p class="n-lead">
                    {!! widget('welcome', 'about-us.description') !!}
                </p>
            </div>
        </div>
        @include('scenes.reason')
    </div>
</section>

