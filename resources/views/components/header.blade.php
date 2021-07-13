<header class="header container">
    <a class="logo-link" href="{{ route('welcome') }}">
        @include('components.logo', ['title' => 'natures'])
    </a>
    <div class="mobile-menu-trigger">
        <span>menu</span>
        <div class="close-icon">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12">
                <defs>
                    <style>.cls-1{fill-rule:evenodd;}</style>
                </defs>
                <title>close</title>
                <path class="cls-1" d="M12,.78,11.22,0,8.75,2.47l.78.78ZM0,.78,5.22,6,0,11.22.78,12,6,6.78,11.22,12l.78-.78L.78,0Z"/>
            </svg>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-menu">
            <nav class="nav nav--fill nav--horizontal">
                <a class="nav-link" href="{{ route('welcome') }}#about" data-scroll="#about" data-offset="-40">{{ trans('menu.about') }}</a>
                <a class="nav-link" href="{{ route('welcome') }}#how-it-work" data-scroll="#how-it-work" data-offset="-40">{{ trans('menu.how_it_works') }}</a>
                <a class="nav-link" href="{{ route('welcome') }}#community" data-scroll="#community" data-offset="-40">{{ trans('menu.community') }}</a>
                <a class="nav-link" href="{{ route('calculator') }}" >{{ trans('menu.calculator') }}</a>
            </nav>
            <div class="site-actions">
                <a href="#" class="mobile-share">Share</a>
                <a @if($paymentBtnDisable)  href="javascript:void(0)" disabled="disabled" @else href="{{ route('donation') }}" @endif class="btn btn-primary btn-donate @if($paymentBtnDisable)disabled @endif"><span>{{ trans('buttons.plant_a_tree') }}</span></a>
            </div>
        </div>
    </div>
{{--    <ul class="lang-select">--}}
{{--        <li>--}}
{{--            <a class="small text-uppercase lang-selected" href="#">{{ \localizer\locale()->iso6391() }}</a>--}}
{{--            <a class="small text-uppercase lang-selected" href="#">{{ \localizer\locale()->iso6391() }} <i class="fa fa-sort-desc" aria-hidden="true"></i></a>--}}
{{--            <ul class="lang-submenu">--}}
{{--                @foreach(\localizer\locales() as $locale)--}}
{{--                    <li class="lang-submenu-item">--}}
{{--                        <a class="small text-uppercase" href="{{ \localizer\url($locale->iso6391()) }}"--}}
{{--                                {!! \localizer\locale()->iso6391() == $locale->iso6391() ? 'class="active"' : '' !!}>{{ $locale->iso6391() }}</a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    </ul>--}}
    <div class="mobile-shape">
        <svg xmlns="http://www.w3.org/2000/svg" width="145" height="283" viewBox="0 0 145 283">
            <defs>
                <style>
                    .cls-1 {
                        fill: #b7eded;
                        fill-rule: evenodd;
                        opacity: 0.5;
                    }
                </style>
            </defs>
            <path id="Ellipse_1_copy_8" data-name="Ellipse 1 copy 8" class="cls-1" d="M-35.214,123c-141.078,0-174.834,70.33-142.457,141.5C-146.94,332.05-113.894,406-35.214,406S197.823,267.4,126.8,234.556C8.571,179.892,43.462,123-35.214,123Z" transform="translate(0 -123)"/>
        </svg>
    </div>
</header>
<a class="n-leap n-leap--up text-uppercase h6" data-scroll="0" data-state="out" href="#" rel="nofollow">
    <span class="n-leap-label">Back to top</span>
    <span class="n-leap-icon">⇁</span>
</a>
