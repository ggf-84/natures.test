@extends('layouts.pdf')

@section('content')

	<div class="wrapper">
	    <div class="section">
	      <h6 class="title">{{ trans('donations.dedicate.' . $donation->dedicate_type) }}</h6>
	      <h1 class="name">{{ $donation->dedicate_name }}</h1>
	      <h4 class="gift-by">{{ trans('certificates.gift_by', ['name' => $donation->name]) }}</h4>
	    </div>
    
	    <div class="content">
	    	{{ trans('certificates.'.$donation->dedicate_type.'_description', [
	        'count' => $donation->trees,
	        'name' => $donation->name,
	        ]) }}
	    </div>

	    <div class="footer">
	      <a href="{{ route('welcome') }}" class="logo">
	        <img src="{{ asset('img/pdf/logo.svg') }}" alt="{{ config('app.name') }}">
	        <span class="logo-title">www.natures.org</span>
	      </a>
	    </div>
  	</div>

@append
