@extends('layouts.pdf')

@section('content')

	<div class="wrapper">
	    <div class="section">
	      <h6 class="title">{{ trans('certificates.this_certificate_is_presented_to') }}</h6>
	      <h1 class="name">{{ $donation->name }}</h1>
	    </div>
    
	    <div class="content">
	    	{{ trans('certificates.appreciation_description', ['count' => $donation->trees]) }}
	    </div>

	    <div class="footer">
	      <a href="{{ route('welcome') }}" class="logo">
	        <img src="{{ asset('img/pdf/logo.svg') }}" alt="{{ config('app.name') }}">
	        <span class="logo-title">www.natures.org</span>
	      </a>
	    </div>
  	</div>
@append