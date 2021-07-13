<section class="n-hero n-section--hero">
    @include('scenes.intro')
    <div class="n-hero-content container">
        <h1 class="display-wow">{!! widget('welcome', 'hero.title') !!}</h1>
        <div class="n-hero-spacer"></div>
        <a @if($paymentBtnDisable)  href="javascript:void(0)" disabled="disabled" @else href="{{ route('donation') }}" @endif class="btn btn-primary @if($paymentBtnDisable)disabled @endif">
           <span> {{ trans('buttons.plant_a_tree') }}</span>
        </a>
    </div>
    <a class="n-leap text-uppercase h6" data-scroll="#about" data-offset="-40" href="#">
        <span class="n-leap-label">{{ trans('buttons.discover') }}</span>
        <span class="n-leap-icon">⇀</span>
    </a>
</section>
