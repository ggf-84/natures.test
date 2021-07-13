<section class="n-section n-section--newsletter mb-6">
    <h6 class="n-section-title">{{ widget('newsletter', 'general.name') }}</h6>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 col-lg-4 offset-lg-4 mb-5">
                <h4 class="display-4 text-center">{!! widget('newsletter', 'general.title') !!}</h4>
            </div>
        </div>

        <div class="row mb-6">
            <div class="col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('subscribe') }}" id="subscribe-form" autocomplete="off">
                    <div class="subscribe-control">
                        <div class="input-box">
                            <input class="form-control form-control-lg" name="email" type="email" placeholder="{{ trans('forms.your_email') }}">
                            <button class="share-action">
                                <span data-title="Subscribe"></span>
                            </button>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="subscribe-loading">
                        <div class="loading">
                            <div class="loading-dots">
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                                <div class="loading-dot"></div>
                            </div>
                            <div class="loading-title">Subscribing</div>
                        </div>
                    </div>
                    <div class="subscribe-complete">
                        <div class="subscribe-complete-icon">
                            <svg width="32px" height="25px" viewBox="0 0 32 25">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-384.000000, -217.000000)" fill-rule="nonzero" fill="#FFFFFF">
                                        <g id="Group" transform="translate(360.000000, 189.000000)">
                                            <path d="M27.4142136,40.5857864 C26.633165,39.8047379 25.366835,39.8047379 24.5857864,40.5857864 C23.8047379,41.366835 23.8047379,42.633165 24.5857864,43.4142136 L34,52.8284271 L55.4142136,31.4142136 C56.1952621,30.633165 56.1952621,29.366835 55.4142136,28.5857864 C54.633165,27.8047379 53.366835,27.8047379 52.5857864,28.5857864 L34,47.1715729 L27.4142136,40.5857864 Z" id="Path-2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h4 class="text-center">Thank you for subscribing</h4>
                        <p class="n-lead text-center">{{ trans('forms.success_subscribe') }}</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
