@extends('auth.layouts.auth')
@section('title', __('Sign In'))
@section('content')
    <div class="user-content-wrapper">
        <div class="user-content-wrapper-inner">
            <div class="user-form">
                <div class="right">
                    <div class="form-top">
                        <h2>{{__('Login')}}</h2>
                        <p>{{__('Log into your pages account')}}</p>
                    </div>
                    {{ Form::open(['route' => 'signInProcess']) }}
                        <div class="form-group">
                            <label for="email">{{__('Email')}}</label>
                            <input name="email"  type="email" class="form-control" placeholder="Your Email here..">
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input name="password"  type="password" class="form-control form-control-password" placeholder="Your Password here..">
                            <span class="eye"><i class="fa fa-eye-slash"></i></span>
                        </div>
                        <div class="d-flex justify-content-between rememberme align-items-center mb-4">
                            <div>
                                <div class="form-group form-check mb-0">
                                    <input class="styled-checkbox form-check-input" id="styled-checkbox-1" type="checkbox" value="value1">
                                    <label for="styled-checkbox-1">Remember Me</label>
                                </div>
                            </div>
                            <div class="text-right"><a href="javascript:;">Forgot Password?</a></div>
                        </div>
                        <button type="submit" class="btn btn-primary nimmu-user-sibmit-button">Login</button>
                    {{ Form::close() }}
                    <div class="form-bottom text-center">
                        <h4 class="or">OR</h4>
                        <div class="social-media">
                            <ul>
                                <li><a href="javascript:;" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:;" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:;" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
{{--                        <p>Already have an account? <a href="sign-up.html">Return to Sign In</a></p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
