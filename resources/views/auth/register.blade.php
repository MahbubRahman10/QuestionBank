@extends('layouts.master')

@section('title')
    @section('titlename')Register
@endsection

@section('content')
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}">

    <div class="container">
        <div class="col-md-12">
            <div class="register" >
                <form id="signup" method="post" action="/register" class="form-inline">
                    {{ csrf_field() }}
                    <h4 style="text-align: center; font-size: 175%;color: #757575;font-weight: 300;">@lang('loginregister.join')</h4><hr><br>    
                    <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">
                    </div>

                    <div class="form-data{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input name="name" type="text" placeholder="@lang('loginregister.name')" class="name" required />
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong style="color: rgb(169, 68, 66);">{{ $errors->first('name') }}</strong>
                        </span>
                        @endif 
                    </div>
                    <div class="form-data{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input name="email" type="email" placeholder="@lang('loginregister.email')" class="email" required/>
                        <h5 class="checkemail" style="padding: 0px 10px; margin-top: 0px; font-weight: 700;"></h5>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color: rgb(169, 68, 66);">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-data{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <input name="mobile" type="text" placeholder="@lang('loginregister.mobile')" class="mobile" required/>
                        <h5 class="checkmobile" style="padding: 0px 10px; margin-top: 0px; font-weight: 700;"></h5>
                        @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong style="color: rgb(169, 68, 66);">{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </dIV>
                    <div class="form-data{{ $errors->has('password') ? ' has-error' : '' }}" >
                        <input name="password" type="password" placeholder="@lang('loginregister.password')" required class="password"/>  <h5 class="checkpassword" style="padding: 0px 10px; margin-top: 0px; font-weight: 700;"></h5>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color: rgb(169, 68, 66);">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-data{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input name="password_confirmation" type="password" placeholder="@lang('loginregister.repassword')"  class="password_confirmation" required/><h5 class="checkrepassword" style="padding: 0px 10px; margin-top: 0px; font-weight: 700;" ></h5>
                        <br>
                    </div>
                    {{-- Google Recaptcha --}}
                    <script src='https://www.google.com/recaptcha/api.js'></script>
                    <div class="g-recaptcha" data-sitekey="6LeFpCUUAAAAAOUioXa31zlGk6XfBI-mwfNoC-kz" style="padding: 0px 10px;"></div> <br> 
                    {{-- \\ End Google Recaptcha --}}

                    <input type="submit"  class="btn" id="signups" value="@lang('loginregister.SignUp')" class="signups"><br><br>
                </form>
            </div>
        </div>
    </div>

    {{-- Register Password Script  --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $(".password").on("input",function (e)  {
                e.preventDefault();
                var password = $(".password").val();
                $('.checkpassword').html('<img src="/img/Loading.gif" width="60" />');
                if (password.length<=5) {
                    $(".checkpassword").css("display", "block");
                    $(".checkpassword").html("password must be at least 6 characters");
                    $(".password").css("border-color", "#a94442");
                    $(".checkpassword").css("color", "#a94442");
                }
                else{
                    // $(".checkpassword").html("password is ok");
                    $(".password").css("border-color", "black");
                    $(".checkpassword").css("display", "none");
                }
            });

        });
    </script>

    {{-- Register Re-Password Script --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('keyup', '.password_confirmation', function(e) {
                e.preventDefault();
                var repassword = $(".password_confirmation").val();
                var password = $(".password").val();
                if (repassword.length>=6) {
                    $(".checkrepassword").css("display", "block")
                    if(repassword==password)
                    {
                        $(".checkrepassword").html("password is matched");
                        $(".password_confirmation").css("border-color", "#3c763d");
                        $(".checkrepassword").css("color", "#3c763d");
                    }
                    else{
                        $(".checkrepassword").html("password is not matched");
                        $(".password_confirmation").css("border-color", "#a94442");
                        $(".checkrepassword").css("color", "#a94442");
                    }
                }
                else{
                    $(".password_confirmation").css("border-color", "black");
                    $(".checkrepassword").css("display", "none");
                }
            });
        });
    </script>

     {{-- Google Recaptcha Script --}}
    <script type="text/javascript">
        $(function(){
            $('.form-inline').submit(function(event){
                var varified=grecaptcha.getResponse();

                // else{
                    // Email Validtion
                    var email = $('.email').val()
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    var testmail  = regex.test(email);
                    if (testmail == false) {
                        event.preventDefault();
                        $(".checkemail").html("Please enter a valid email");
                        $(".email").css("border-color", "#a94442");
                        $(".checkemail").css("color", "#a94442");
                    }

                    // Mobile Validation
                    var mobile = $('.mobile').val()
                    if (mobile.length != '11') {
                        event.preventDefault();
                         $(".checkmobile").css("display", "block");
                        $(".checkmobile").html("Mobile number must be 11 digits");
                        $(".mobile").css("border-color", "#a94442");
                        $(".checkmobile").css("color", "#a94442");

                        setTimeout(function(){
                            
                             $(".mobile").css("border-color", "black");
                             $(".checkmobile").css("display", "none");
                            
                        }, 3000)
                    }
                    else if($.isNumeric(mobile) == false){
                        event.preventDefault();
                        $(".checkmobile").css("display", "block");
                        $(".checkmobile").html("Mobile number should be numeric only");
                        $(".mobile").css("border-color", "#a94442");
                        $(".checkmobile").css("color", "#a94442");

                        setTimeout(function(){
                         $(".mobile").css("border-color", "black");
                         $(".checkmobile").css("display", "none");
                       }, 5000)
                    }


                    $.ajax({
                        type:"GET",
                        url :"/checkemailphone",
                        data:{'email':email,'mobile':mobile},
                        dataType:"JSON",
                        success:function(data){
                           if (data == '401') {
                            event.preventDefault();
                            $(".checkemail").css("display", "block")
                            $(".checkemail").html("This email is already used");
                            $(".email").css("border-color", "#a94442");
                            $(".checkemail").css("color", "#a94442");
                           }
                           else if(data == '402'){
                            $(".checkmobile").css("display", "block");
                            $(".checkmobile").html("This mobile number is already used");
                            $(".mobile").css("border-color", "#a94442");
                            $(".checkmobile").css("color", "#a94442");
                           }
                        },
                        error:function(){
                            // alert("error")
                        },
                    });


                    // Password Validation
                    var repassword = $(".password_confirmation").val();
                    var password = $(".password").val();

                    if (password.length<=5) {
                        event.preventDefault();
                        $(".checkpassword").css("display", "block");
                        $(".checkpassword").html("password must be at least 6 characters");
                        $(".password").css("border-color", "#a94442");
                        $(".checkpassword").css("color", "#a94442");

                        setTimeout(function(){
                            $(".password").css("border-color", "black");
                           $(".checkpassword").css("display", "none");
                       }, 5000)
                    }

                    // Confirm Password Validation
                    if(repassword!=password)
                    {   event.preventDefault();
                        $(".checkrepassword").css("display", "block");
                        $(".checkrepassword").html("password is not matched");
                        $(".password_confirmation").css("border-color", "#a94442");
                        $(".checkrepassword").css("color", "#a94442");

                        setTimeout(function(){
                            $(".password_confirmation").css("border-color", "black");
                            $(".checkrepassword").css("display", "none");
                        }, 5000)

                    }
                
                    // Captcha validation
                    if (varified.length===0) {
                        event.preventDefault();
                    }




                // }
            });
        });
    </script>

@endsection