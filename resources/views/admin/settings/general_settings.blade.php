@extends('layouts.master')
@section('title', __('General Settings'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.min.css')}}">
@endsection
@section('content')
    <div class="nimmu-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <ul class="d-flex mb-3 col-lg-8"><li>@if (isset($pageTitle)) {{ $pageTitle }} @endif</li></ul>
            </div>
        </div>
    </div>
    <div class="nimmu-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{ Form::open(['route' => 'admin.settingsSaveProcess', 'files' => true ]) }}
                                <div class="row">
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="phone">{{ __('Phone') }}</label>
                                        <input type="text" name="{{'phone'  . '_' . Auth::id()}}" class="form-control" id="phone" value="{{ (isset($settings) && isset($settings['phone' . '_' . Auth::id()])) ? $settings['phone' . '_' . Auth::id()] : '' }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="tax">{{ __('Tax(%)') }}</label>
                                        <input type="number" step="0.01" min="0" name="{{'tax'  . '_' . Auth::id()}}" class="form-control" id="tax" value="{{ (isset($settings) && isset($settings['tax' . '_' . Auth::id()])) ? $settings['tax' . '_' . Auth::id()] : '' }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label for="discount">{{ __('Discount(%)') }}</label>
                                        <input type="number" step="0.01" min="0" name="{{'discount'  . '_' . Auth::id()}}" class="form-control" id="discount" value="{{ (isset($settings) && isset($settings['discount' . '_' . Auth::id()])) ? $settings['discount' . '_' . Auth::id()] : '' }}">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="about_us">{{ __('About Us') }}</label>
                                        <textarea rows="5" class="form-control" name="{{'about_us'  . '_' . Auth::id()}}">{{ isset($settings) && isset($settings['about_us_' . Auth::id()]) ? $settings['about_us_' . Auth::id()] : (old("about_us_" . Auth::id()) ? old("about_us_" . Auth::id()) : "") }}</textarea>
                                        <pre class="text-danger">{{$errors->first("about_us_" . Auth::id())}}</pre>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="logo">{{__('Home Page Image')}}</label>
                                        <input type="file" name="{{'home_page_image'  . '_' . Auth::id()}}" id="input-file-now" class="dropify" data-default-file="{{ isset($settings) && isset($settings['home_page_image_' . Auth::id()]) ? asset(appImageViewPath() . $settings['home_page_image_' . Auth::id()]) : (old("home_page_image_" . Auth::id()) ? old("home_page_image_" . Auth::id()) : "") }}" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="logo">{{__('About Us Image')}}</label>
                                        <input type="file" name="{{'about_us_image'  . '_' . Auth::id()}}" id="input-file-now" class="dropify" data-default-file="{{ isset($settings) && isset($settings['about_us_image_' . Auth::id()]) ? asset(appImageViewPath() . $settings['about_us_image_' . Auth::id()]) : (old("about_us_image_" . Auth::id()) ? old("about_us_image_" . Auth::id()) : "") }}" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="logo">{{__('Service Image')}}</label>
                                        <input type="file" name="{{'service_image'  . '_' . Auth::id()}}" id="input-file-now" class="dropify" data-default-file="{{ isset($settings) && isset($settings['service_image_' . Auth::id()]) ? asset(appImageViewPath() . $settings['service_image_' . Auth::id()]) : (old("service_image_" . Auth::id()) ? old("service_image_" . Auth::id()) : "") }}" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="logo">{{__('Availability Image')}}</label>
                                        <input type="file" name="{{'availability_image'  . '_' . Auth::id()}}" id="input-file-now" class="dropify" data-default-file="{{ isset($settings) && isset($settings['availability_image_' . Auth::id()]) ? asset(appImageViewPath() . $settings['availability_image_' . Auth::id()]) : (old("availability_image_" . Auth::id()) ? old("availability_image_" . Auth::id()) : "") }}" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="logo">{{__('Contact Us Image')}}</label>
                                        <input type="file" name="{{'contact_us_image'  . '_' . Auth::id()}}" id="input-file-now" class="dropify" data-default-file="{{ isset($settings) && isset($settings['contact_us_image_' . Auth::id()]) ? asset(appImageViewPath() . $settings['contact_us_image_' . Auth::id()]) : (old("contact_us_image_" . Auth::id()) ? old("contact_us_image_" . Auth::id()) : "") }}" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="logo">{{__('Call Us Image')}}</label>
                                        <input type="file" name="{{'call_us_image'  . '_' . Auth::id()}}" id="input-file-now" class="dropify" data-default-file="{{ isset($settings) && isset($settings['call_us_image_' . Auth::id()]) ? asset(appImageViewPath() . $settings['call_us_image_' . Auth::id()]) : (old("call_us_image_" . Auth::id()) ? old("call_us_image_" . Auth::id()) : "") }}" />
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type='text/javascript' src='{{ asset('assets/js/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
