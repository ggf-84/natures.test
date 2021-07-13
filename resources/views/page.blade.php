@extends('layouts.app')

@section('content')
    <section class="n-section--terms text-left flex-column align-items-center justify-content-center py-7 container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @foreach($paragraphs as $paragraph)
                    <div class="mb-6 text-block">
                        <h4 class="display-4 mb-5">{{ $paragraph->title }}</h4>
                        <div class="n-lead">
                            {!! $paragraph->description  !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
