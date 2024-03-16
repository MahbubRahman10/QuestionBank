@extends('layouts.master')

@section('title')
    @section('titlename')Login
@endsection

@section('content')

    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">

    <div class="container" >
        <div class="col-md-12">
            <div class="login" >
                <form id="signup" method="post" action="{{ LaravelLocalization::localizeURL('/login') }}" >
                    {{ csrf_field() }}
                    @if (\Session::has('successactive'))
                    <div class="alert alert-success">
                        <ul>
                            <li style="list-style: none;">{!! \Session::get('successactive') !!}</li>
                        </ul>
                    </div>
                    @endif
                    <h4 style="text-align: center; font-size: 175%;color: #757575;font-weight: 300;"> @lang('loginregister.Login') </h4><hr><br>
                    {{-- Social Login --}}
                    <div class="socials">
                        <span>
                            <a href="/login/facebook"> <div class="fb-icon-bg"><i class="fa fa-facebook" style="background: #354f88; font-size: 27px; padding: 3px 12px; margin-top: 2px;color: white;" ></i></div>
                                <div class="fb-bg"></div>
                            </a>
                        </span>
                        <span>
                            <a href="/login/twitter">
                                <div class="twi-icon-bg"> <i class="fa fa-twitter" style="background: #40a2d1; font-size: 27px; padding: 3px 8px; margin-top: 2px;color: white;" > </i></div>
                                <div class="twi-bg"></div> 
                            </a>
                        </span>
                        <span style="margin-left: 70px; top: -100px;">
                            <a href="/login/google">
                                <div class="google-icon-bg"> <i class="fa fa-google" style="background: #C9392D; font-size: 27px; padding: 3px 8px; margin-top: 2px;color: white;" > </i></div>
                                <div class="google-bg"></div> 
                            </a>
                        </span>
                    </div> 
                    {{-- // End Social Login --}}       
                    {{-- <h4 class="soc"> @lang('loginregister.or') </h4> --}}
                    <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">
                    </div>
                    {{-- Email Login --}}
                    <input name="email" type="email" placeholder="@lang('loginregister.email')" required="required"/>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: rgb(169, 68, 66);">{{ $errors->first('email') }}</strong>
                    </span>
                    @endif <br>
                    <input name="password" type="password" placeholder="@lang('loginregister.password')" required="required" /><br>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: rgb(169, 68, 66);">{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <label class="checkbox">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> @lang('loginregister.remember')
                    </label>
                    <button  type="submit" class="btn btn-primary" id="signin">@lang('loginregister.SignIN')</button><br><br>
                    {{-- \\ End Email Login --}}
                    {{-- Register LINK --}}
                    <label class="ma" style="padding: 0px 40px;">
                        <span > @lang('loginregister.Needanaccount?') </span>
                        <a href="{{ url('/register') }}"> @lang('loginregister.RegisterHere') </a>
                    </label> 
                    {{-- \\ End Register LINK --}}  
                    {{-- Forgot Password LINK --}}                      
                    <label class="forget">
                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            @lang('loginregister.ForgotYourPassword')
                        </a>
                    </label>     
                    {{-- Forgot Password LINK --}}   
                </form>
            </div>
        </div>
    </div>

@endsection