<section class="n-section n-section--planted">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                @include('scenes.planted')
            </div>
            <div class="col-lg-4 offset-lg-1">
                <h6 class="n-section-title">{{ widget('welcome', 'trees-planted.name') }}</h6>
                <h1 class="display-wow">{!! widget('welcome', 'trees-planted.count') !!}</h1>
                <a @if($paymentBtnDisable)  href="javascript:void(0)" disabled="disabled" @else href="{{ route('donation') }}" @endif class="btn btn-primary @if($paymentBtnDisable)disabled @endif">
                   <span> {{ trans('buttons.act_now') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>
