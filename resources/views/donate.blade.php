@extends('layouts.app')

@section('content')
    <section class="n-section">
        <div class="container py-5 py-lg-7">
            <h4 class="display-4 mb-5 text-center">{{ trans('forms.plant_a_tree') }}</h4>

            {!! Form::open(['method' => 'post', 'id' => 'donate-form']) !!}

            <div class="row mb-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="d-flex justify-content-center">
                        <label class="switch">
                            <input name="type" id="type" value="corporate" type="checkbox"{{ old('type') == 'corporate' ? ' checked' : '' }}>
                            <span>
                                <strong class="switch-label switch-off" data-title="{{ trans('donations.types.personal') }}"></strong>
                                <em class="switch-input"></em>
                            <strong class="switch-label switch-on" data-title="{{ trans('donations.types.corporate') }}"></strong>
                            </span>
                        </label>
                    </div>

                    {{--<div class="input-box big-select">--}}
                        {{--<div class="form-control-box-select">--}}
                            {{--<div class="select-wraper">--}}
                                {{--{!! Form::select('type', $donationTypes, null, ['id' => 'type', 'class' => 'form-control form-control-lg']) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            {{--<div class="d-flex justify-content-center">--}}
                {{--<h6 class="n-section-title mb-6">{{ trans('forms.donation') }}</h6>--}}
            {{--</div>--}}

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="input-box input-box--alt">
                        {{--<div class="row">--}}
                            {{--<div class="form-group col-lg-12">--}}
                                {{--<label class="form-label" for="payment_type">{{ trans('forms.payment_method') }}</label>--}}
                                {{--<div class="form-control-box-select">--}}
                                    {{--<div class="select-wraper donation-select">--}}
                                        {{--<input type="text" name="payment_type" value="paypal"--}}
                                               {{--class="form-control form-control-lg" readonly>--}}
                                        {{--                                            {!! Form::select('payment_type', $paymentMethods, null, ['id' => 'payment_type',--}}
                                        {{--                                            'class' => 'form-control form-control-lg' . ($errors->has('payment_type') ? ' is-invalid' : '')]) !!}--}}

                                        {{--                                            @if($errors->has('payment_type'))--}}
                                        {{--                                                <div class="invalid-feedback">{{ $errors->first('payment_type') }}</div>--}}
                                        {{--                                            @endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="mb-4">
                            <div class="row position-relative">
                                <div class="form-group col-6">
                                    <div class="form-control-box calculation-control-box">
                                        {!! Form::text('amount', old('amount', options_find('price_tree')), ['id' => 'amount', 'data-price' => options_find('price_tree'),
                                        'class' => 'form-control form-control-lg calculation-input' . ($errors->has('amount') ? ' is-invalid' : '')]) !!}
                                        <span class="input-title form-label">Amount</span>
                                        @if($errors->has('amount'))
                                            <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <span class="equal-sign">=</span>
                                <div class="form-group col-6">
                                    <div class="form-control-box calculation-control-box">
                                        {!! Form::number('trees', old('trees', 1), ['id' => 'trees', 'min' => 1,
                                        'class' => 'form-control form-control-lg calculation-input' . ($errors->has('trees') ? ' is-invalid' : '')]) !!}
                                        <span class="input-title form-label">Trees</span>
                                        @if($errors->has('trees'))
                                            <div class="invalid-feedback">{{ $errors->first('trees') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row {{ old('type') == 'corporate' ? ' d-none' : '' }}" data-type="personal">
                                <div class="form-group col-12 ">
                                    {{--<div class="pretty p-default p-curve p-fill form-check">--}}
                                        {{--{!! Form::checkbox('dedicated', 1, false, ['id' => 'dedicated', 'class' => 'form-check-input']) !!}--}}
                                        {{--<div class="state">--}}
                                            {{--<label class="form-check-label"--}}
                                                   {{--for="dedicated">{{ trans('forms.dedicate_donation') }}</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <label class="switch switch--single">
                                        <input type="checkbox" name="dedicated" value="1" id="dedicated"{{ old('dedicated') ? ' checked' : '' }}>
                                        <span>
                                            <em class="switch-input"></em>
                                            <strong class="switch-label switch-on" data-title="{{ trans('forms.dedicate_donation') }}"></strong>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-center{{ !old('dedicated') ? ' d-none' : ' d-flex' }}"
                             data-flex="true" data-dedicated="true">
                            <h6 class="n-section-title mb-5">{{ trans('forms.dedicate_donation') }}</h6>
                        </div>

                        <div class="row{{ !old('dedicated') ? ' d-none' : '' }}" data-dedicated="true">
                            <div class="form-group col-md-6">
                                <label class="form-label"
                                       for="dedicate_type">{{ trans('forms.dedicate_donation') }}</label>
                                <div class="form-control-box">
                                    <div class="form-control-box-select">
                                        <div class="select-wraper">
                                            {!! Form::select('dedicate_type', $dedicateTypes, null, ['id' => 'dedicate_type',
                                            'class' => 'form-control form-control-lg' . ($errors->has('dedicate_type') ? ' is-invalid' : '')]) !!}
                                            @if($errors->has('dedicate_type'))
                                                <div class="invalid-feedback">{{ $errors->first('dedicate_type') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label"
                                       for="dedicate_name">{{ trans('forms.honoree_s_name') }}</label>
                                <div class="form-control-box">
                                    {!! Form::text('dedicate_name', null, ['id' => 'dedicate_name',
                                    'class' => 'form-control form-control-lg' . ($errors->has('dedicate_name') ? ' is-invalid' : '')]) !!}
                                    @if($errors->has('dedicate_name'))
                                        <div class="invalid-feedback">{{ $errors->first('dedicate_name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5{{ !old('dedicated') ? ' d-none' : '' }}" data-dedicated="true">
                            <div class="form-group col-md-12">
                                <label class="form-label" for="dedicate_message">{{ trans('forms.message') }}</label>
                                <div class="form-control-box">
                                    {!! Form::textarea('dedicate_message', null, ['id' => 'dedicate_message', 'rows' => 3,
                                    'class' => 'form-control form-control-lg']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <h6 class="n-section-title mb-5{{ old('type') == 'corporate' ? ' d-none' : '' }}"
                                data-type="personal">{{ trans('forms.personal_info') }}</h6>
                            <h6 class="n-section-title mb-5{{ old('type') != 'corporate' ? ' d-none' : '' }}"
                                data-type="corporate">{{ trans('forms.company_info') }}</h6>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label{{ old('type') == 'corporate' ? ' d-none' : '' }}" for="name"
                                       data-type="personal">{{ trans('forms.full_name') }}</label>
                                <label class="form-label{{ old('type') != 'corporate' ? ' d-none' : '' }}" for="name"
                                       data-type="corporate">{{ trans('forms.company_name') }}</label>
                                <div class="form-control-box">
                                    {!! Form::text('name', null, ['id' => 'name',
                                    'class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="country_id">{{ trans('forms.country') }}</label>
                                <div class="form-control-box-select">
                                    <div class="select-wraper">
                                        {!! Form::select('country_id', $countries, $defaultCountry->id, [
                                            'id' => 'country_id',
                                            'class' => 'form-control form-control-lg' . ($errors->has('country_id') ? ' is-invalid' : '')
                                        ]) !!}
                                        @if($errors->has('country_id'))
                                            <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="phone">{{ trans('forms.phone') }}</label>
                                <div class="form-control-box">
                                    {!! Form::text('phone', null, ['id' => 'phone',
                                    'class' => 'form-control form-control-lg' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="city">{{ trans('forms.city') }}</label>
                                <div class="form-control-box">
                                    {!! Form::text('city', null, ['id' => 'city',
                                    'class' => 'form-control form-control-lg' . ($errors->has('city') ? ' is-invalid' : '')]) !!}
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label" for="email">{{ trans('forms.email') }}</label>
                                <div class="form-control-box">
                                    {!! Form::email('email', null, ['id' => 'email',
                                    'class' => 'form-control form-control-lg' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label" for="address">{{ trans('forms.address') }}</label>
                                <div class="form-control-box">
                                    {!! Form::text('address', null, ['id' => 'address',
                                    'class' => 'form-control form-control-lg' . ($errors->has('address') ? ' is-invalid' : '')]) !!}
                                    @if($errors->has('address'))
                                        <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="form-label" for="comment">{{ trans('forms.comment') }}</label>
                                <div class="form-control-box">
                                    {!! Form::textarea('comment', null, ['id' => 'comment', 'rows' => 3,
                                    'class' => 'form-control form-control-lg']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label class="switch switch--single">
                                    <input type="checkbox" name="terms" value="1" id="terms">
                                    <span>
                                        <em class="switch-input"></em>
                                        <strong class="switch-label switch-on" data-title="Agree with Privacy and Terms"></strong>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex col-10 offset-1 justify-content-center">
                                <button type="submit" disabled class="btn btn-primary" id="btn-donate"><span>{{ trans('buttons.donate') }} via Paypal</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{--<div class="row mb-5">--}}
                {{--<div class="d-flex col-10 offset-1 justify-content-center">--}}
                    {{--<div class="pretty p-default p-curve p-fill form-check">--}}
                        {{--{!! Form::checkbox('terms', 1, false, ['id' => 'terms',--}}
                    {{--'class' => 'form-check-input' . ($errors->has('terms') ? ' is-invalid' : '')]) !!}--}}
                        {{--<div class="state">--}}
                            {{--<label class="form-check-label" for="terms">--}}
                                    {{--<span>--}}
                                        {{--{!! trans('forms.agree_with_terms', [--}}
                                        {{--'privacy_link' => route('page.show', 'privacy-policy'),--}}
                                        {{--'terms_link' => route('page.show', 'terms-of-service')--}}
                                        {{--]) !!}--}}
                                    {{--</span>--}}
                            {{--</label>--}}
                            {{--@if($errors->has('terms'))--}}
                                {{--<div class="invalid-feedback">{{ $errors->first('terms') }}</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="row">--}}
                {{--<div class="d-flex col-10 offset-1 justify-content-center">--}}
                    {{--<button type="submit" class="btn btn-primary"><span>{{ trans('buttons.donate') }}</span></button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {!! Form::close() !!}

        </div>
    </section>
@endsection
