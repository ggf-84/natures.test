<section class="n-section n-section--how" id="how-it-work">
    <h6 class="n-section-title">{{ widget('welcome', 'how-it-works.name') }}</h6>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                @include('scenes.plant')
            </div>
            <div class="col-lg-4 offset-lg-1">
                <h4 class="display-4">{!! widget('welcome', 'how-it-works.what-we-do-title-first') !!}</h4>
                <p class="n-lead">{!! widget('welcome', 'how-it-works.what-we-do-description-first') !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                @include('scenes.ride')
            </div>
            <div class="col-lg-4 offset-lg-1">
                <h4 class="display-4">{!! widget('welcome', 'how-it-works.what-we-do-title-second') !!}</h4>
                <p class="n-lead">{!! widget('welcome', 'how-it-works.what-we-do-description-second') !!}</p>
            </div>
        </div>
        <div class="n-leaf"></div>
        <div class="row">
            <div class="col-10 offset-1 col-lg-3 offset-lg-1">
                <h4 class="display-4">{!! widget('welcome', 'how-it-works.you-can-help-title') !!}</h4>
            </div>
            <div class="col-lg-4 offset-lg-3">
                <p class="n-lead">{!! widget('welcome', 'how-it-works.you-can-help-description') !!}</p>
            </div>
        </div>
    </div>
</section>