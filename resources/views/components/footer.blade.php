<footer class="n-footer">
    <div class="container">
        <div class="row mb-5 top-footer">
            <div class="col-md-3 offset-lg-2 sub-menu">
                <nav class="nav flex-column align-items-start">
                    <h6 class="nav-title accordion">{{ trans('menu.get_in_touch') }}</h6>
                    <div class="panel">
                        <a class="nav-link" href="mailto:business@natures.org">{{ options_find('email') }}</a>
                        <a class="nav-link" href="tel:+37369480480">{{ options_find('phone') }}</a>
                    </div>
                </nav>
            </div>
            <div class="col-md-3 sub-menu">
                <nav class="nav flex-column align-items-start">
                    <h6 class="nav-title accordion">{{ trans('menu.legal') }}</h6>
                    <div class="panel">
                        <a class="nav-link" href="{{ route('page.show', 'privacy-policy') }}">{{ trans('menu.privacy-policy') }}</a>
                        <a class="nav-link" href="{{ route('page.show', 'terms-of-service') }}">{{ trans('menu.terms-of-service') }}</a>
                        <a class="nav-link" href="{{ route('page.show', 'faq') }}">{{ trans('menu.faq') }}</a>
                    </div>
                </nav>
            </div>
            <div class="col-md-3 sub-menu">
                <nav class="nav flex-column align-items-start">
                    <h6 class="nav-title accordion">{{ trans('menu.socials') }}</h6>
                    <div class="panel">
                        <a target="_blank" class="nav-link" href="{{ options_find('facebook_link') }}">Facebook</a>
                        <a target="_blank" class="nav-link" href="{{ options_find('instagram_link') }}">Instagram</a>
                        <a target="_blank" class="nav-link" href="{{ options_find('twitter_link') }}">Twitter</a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row align-items-lg-center">
            <div class="col-lg-3 offset-lg-2 credits-action">
                <a class="nav-link" href="{{ route('credits') }}">{{ trans('menu.credits') }}</a>
                <a class="n-hero-discover-icon" href="{{ route('credits') }}">⇀</a>
{{--                <span class="n-hero-discover-icon">⇀</span>--}}
            </div>
            <div class="col-lg-3 copyright-col">
                <span class="n-copyright">&copy; Natures {{ \Carbon\Carbon::now()->year }}</span>
            </div>
            <div class="col-lg-3 payment-card-items d-flex flex-row align-items-center">
                {{--<div class="payment-card-item">--}}
                    {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="44" height="26" viewBox="0 0 44 26">--}}
                        {{--<image id="Mastercard" width="44" height="26" xlink:href="data:img/png;base64,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"/>--}}
                    {{--</svg>--}}
                {{--</div>--}}
                {{--<div class="payment-card-item">--}}
                    {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="44" height="26" viewBox="0 0 44 26">--}}
                        {{--<image id="Maestro" width="44" height="26" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAaCAYAAADMp76xAAAF80lEQVRYhb2YeWwUdRTHPzN799htuz04WkEqAqaCEhUESxWCgEpUvEUFUxERYyKGREm8oiYmnn9ggoktKgKiYASpEhDBs1TOLqniUSx1oZfbsm13u8fsjJnf7kq7rUJ2jN9ks5n3m3m/z7z5zfu9NxJnU1XjJOBWYAZwEZCfuCIE/Ar8AGwDdlBZGhnKm694ohWYA8wHpgJjAXtyGPgR+ArY4vZ6jvwb0T8DVzVWAM8D5We9qbhagJeB1VSWRhOgFuAh4AlgxDn6qQVWub2evecGXNXoAN4AHjzHCVJVD9zle+ZmDfgAmJSmn7eBR91eT19/o5wC6wa+NACra9K0Ew0HIiaz/mjThdX1gL5MfMUTC/obzwDHI/tZYo2lrfxAN8u/25axv2Scrc9i8xvxBVwO1PiKJ2YmDWeWRFVjNXC/wQkGqKy1Sd27ZoUiaZrVoKt33F6PYJMSsLOAL4wCvvTZ29xRv2eALTMSwqSqRl3rmuP2enaaEwcvGvVmicXoyHSxZur8QWOPfbPZb4nFXAan0Bl3SlQ1XgHUGXTGqK42nOHgkGOrdq/3XfvLQbfROYAp5sSmMEDjXRamFsbz+g5vkNa+GPeUZmGWJbrCKlubA4M8bXnvOc7vbPmnif6GtZRfiVyUT3jzp+kA32YeamNYMs7JirL4E7xhVyt9isa6ikJx/GlzkJ0ng0zIsZJhlvjZH6UzGOXpOYvIzrAyZkQurZ0B2jp7xflZDivFBU6e2v1+SPv5N3vGC08iZTiI1h4AWUay29C6ToPZjNp5GvMlZWJcOXwUzd+dinaVDjw+1Xqp20pQ0QSQRZZYVuYkompYZYkDf4bZNXc404viT0C3z97Rgu38mVRXFIpr9B1jRZ2P4z1R1s0sEtfxyGx7zy33YxpdIkBtdy/AcvV0TKPPE7Dhdz/AevP1yMPigdF6A/Tc9zDK/gE79Xg9D+cMBrYJMF2T3VauK8mgtj1+fMgX5uHaP5lRc0pA6TDlRQ7WlhdwMqgweetJ6jsjLB6bzV1jssT4nXvaOTBv8UlNUQRsqHoDobUbMY27QEQz9GY1loppAjaw6kV6Fj2ClJWJ/aHFqWg55lTL6CwzOVaZr1v7mDHMzvIJLpp6FP4IKGI8psHn1w4X5/TF4ulKD6DLKovfoRtHCttXrSE2/R7gplGZbLymkPauO52muh/EWPSbWuTcHCSbjcj2nYSq1+NYuRzV20J43YcCVvh15w1axHqEB+xGk/Nt4n9PS0j859lk3mjwMynPSltfjMoLsxnmMFGy6QQfN8Wzwi9+Uevw1rFu8tY3UbDhBEu+66DmjyBjPmrmx64IRQvmZpsmjBXnqb83YyqLr8Tot3VooTDEVKTsTKQcF/bKhWJMqW9I5fXrET6mp4uk5ZI869+Pvjeqosdw4/FeXpviFi9bc0AREW1YUEKuVUZRNT5pDrD7VB9LxztZWJqF1STx8lE/Ky924Y+oFNhNRL/fr0pmiygFXF9sEctCPDFPAygK4Q2bsd17O7lHv47bG5sIra5KBT6m5+FXgMeTFj2l5dtNfNsW4qoiO91RVURQT3OnggrHexTmjnQIuzcQo8hhorY9hEmCaYV2RmWZ6YqoHO2KiJt3mGScTcfVl55dJkuZGVhmlqOeakE73Y2cn0d0/2FQYiBJWK68DHnkCNS2dqL7DkJkUHn9qg48NVGDGtLy77eypK5mSBeuUEBxhoKD3pc0NC1ZSxzWV4MRT/pOt3Tf9kH2jGiYew/u+g9YOeL2ei5N3vUTosUxoBO5RbwwayH5wYHJflntNl//nc6AniSlvHwHWGTEozMUZO+aFSLa/7HWub2e+1KB9eSn91GXGZlLrycmtDeLQv6V7WsUk6oaXbuHgAq319PLoJ6uqlFvR2oSlX7akjSt58jrS33F/o7RBmEPAvPcXk9H0jCwp6ss1QcqEg1guqrXJGlKsb9jXqIhTVdrE5Ht6H/92dp8vWiefo4TJtv8N5PfJ9Js8/cl2vyBrctZgc+A/x8fUn7q9yFFT7FDC/gLBfQ/OlUL4akAAAAASUVORK5CYII="/>--}}
                    {{--</svg>--}}
                {{--</div>--}}
                <div class="payment-card-item">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="24" viewBox="0 0 21 24">
                        <image id="PayPal" width="21" height="24" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAYCAYAAAAVibZIAAAB70lEQVQ4jaWVS2sUQRRGT006005QjGMe+IhiZIhtEhXcCLNLEHyAGxF3IkiDhETQ/IHeunHlYyHBn+DGpdssZif4iDhrlQZFEA3pSXeXlKak7K7OFPFbVd97+3BvfVxKYKjVjp4At+mvdeAD0AGedVejjvlHEfoF2O8ALeohcKe7GkkVrxnA0R0ClRaBBf1RMxLBDoFa92zQk/8JnWy1o4Y6eP2gMt2APLVjhAAxgKh5UPN+AJtFqGV8Sb7+1a1Pb7D3c2HpwfjN63dN6HSZmbsBgbw52gSWgM+/77TVjvYCB8rMzBmazs7q4y1tlN35rOdG3DXE5vTfQY9rqN0kF6gQJBcvm5GevtNq57fTgEdy/gLpxIRZ9F5Drc4jpZ04WCc7OkkyP4/0/WL2pYbOlJBCkM2cQdbrf759H9lokB0+RD68r6p91cWK12pHQ8CRYjYfabIxN7f9+GU9jsPgnTLqhC2bNyu7qdJzYJmt3S+NrpSOjbjCXgM3gKtxGCRsremUFXqwtAtKXeA+oPb8G/AmDoNPxSLPup5CIBslV5UexWGw0q/1mg0q/XpV/dt+QA09Vgzme3bHFfVrLlA1/hVgzAwmZ09dAy4Var/HYfDRBfrPw6c1/nTtFXC6EO7EYXDOBWo+J6aGLbEXLkCAXxufd9qvxud3AAAAAElFTkSuQmCC"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="img-abs-left">
        <svg xmlns="http://www.w3.org/2000/svg" width="203" height="639" viewBox="0 0 203 639">
            <defs>
                <style>
                    .cls-1 {
                        fill: #b7eded;
                        fill-rule: evenodd;
                        opacity: 0.5;
                    }
                </style>
            </defs>
            <path id="Ellipse_1_copy_3" data-name="Ellipse 1 copy 3" class="cls-1" d="M-224.584,7550c-380.133,0-471.089,189.62-383.847,381.5,82.8,182.12,171.845,381.5,383.847,381.5s627.915-373.69,436.537-462.23C-106.606,7703.39-12.592,7550-224.584,7550Z" transform="translate(-58 -7550)"/>
        </svg>
    </div>
    <div class="img-abs-right">
        <svg xmlns="http://www.w3.org/2000/svg" width="761" height="441" viewBox="0 0 761 441">
            <defs>
                <style>
                    .cls-1 {
                        fill: #a4edbb;
                        fill-rule: evenodd;
                        opacity: 0.5;
                    }
                </style>
            </defs>
            <path id="Ellipse_1_copy_4" data-name="Ellipse 1 copy 4" class="cls-1" d="M1077.42,8511c-380.137,0-471.093-189.62-383.851-381.5,82.8-182.12,171.845-381.5,383.851-381.5,211.99,0,627.91,373.69,436.53,462.23C1195.39,8357.61,1289.41,8511,1077.42,8511Z" transform="translate(-663 -7748)"/>
        </svg>
    </div>
</footer>