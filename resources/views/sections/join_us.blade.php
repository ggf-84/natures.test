<section class="n-section n-section--join" id="community">
    <h6 class="n-section-title">{{ widget('join-us', 'general.name') }}</h6>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 col-lg-4 offset-lg-4">
                <h4 class="display-4">{!! widget('join-us', 'difference.title') !!}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <p class="n-lead">{!! widget('join-us', 'difference.description') !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2 col-lg-4 offset-lg-4">
                <nav class="nav justify-content-between">
                    <a class="nav-link" href="{{ options_find('facebook_link') }}" target="_blank">facebook</a>
                    <a class="nav-link" href="{{ options_find('twitter_link') }}" target="_blank">twitter</a>
                    <a class="nav-link" href="{{ options_find('instagram_link') }}" target="_blank">instagram</a>
                </nav>
            </div>
        </div>
        <div class="row row--last" id="share-links">
            <div class="col-lg-6 mb-6 mb-lg-0">
                @include('scenes.share')
            </div>
            <div class="col-lg-4 offset-lg-1">
                <h4 class="display-4">{!! widget('join-us', 'share.title') !!}</h4>
                <p class="n-lead mb-5">{!! widget('join-us', 'share.description') !!}</p>
                <div class="row">
                    <div class="col-8 col-lg-8 offset-2 offset-lg-0">
                        <nav class="nav">
                            <a class="nav-link" href="{{ $share->facebook }}" target="_blank">facebook</a>
                            <a class="nav-link" href="{{ $share->twitter }}" target="_blank">twitter</a>
{{--                            <a class="nav-link" href="https://plus.google.com/share?url={{ urlencode(url()->full()) }}" target="_blank">google</a>--}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
