<section class="n-section n-section--involved mb-6">
    <h6 class="n-section-title">{{ trans('general.get_involved') }}</h6>
    <a @if($paymentBtnDisable)  href="javascript:void(0)" disabled="disabled" @else href="{{ route('donation') }}" @endif class="display-wow text-center @if($paymentBtnDisable)f-disabled @endif">{{ trans('general.plant_a_tree') }}</a>
</section>

