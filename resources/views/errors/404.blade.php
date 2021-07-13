@extends('layouts.app')

@section('content')
    <section class="n-section page-not-found">
        <div class="container py-4 py-lg-6">
            <div class="row align-items-center">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <figure class="n-scene n-scene--bike">
                        <picture class="n-scene-picture">
                            <img class="n-scene-image" src="/img/bike.png" alt="">
                        </picture>

                    </figure>

                </div>
                <div class="col-lg-3 offset-lg-3 text-center text-lg-left">
                    <h4 class="display-4 mb-3 mb-lg-5">{{ trans("general.page-not-found") }}.</h4>
                    <a class="home-action" href="{{ route('welcome') }}">{{ trans("buttons.back_to_home") }} </a>
                </div>
                <div class="n-leaf"></div>
            </div>
        </div>
    </section>
@endsection