<!DOCTYPE html>
<html>
<head>
    <title>Qbank Dashboard Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background: #eee;">

    <div class="container" >
        <div class="col-md-4 col-md-offset-4" style="background: white; margin-top:55px;padding: 40px 20px; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important">
            <div style="margin-left: 36%;"><i class="fa fa-lock" style="font-size: 70px; background: #495057; padding: 20px 30px; border-radius: 50%; color: white;"></i>
            </div>
            <h1 style="text-align: center; font-family: 'Stencil Std', fantasy;">ADMIN</h1>
            <br>
            <form id="signup" method="post" action="/admin/login" >
                {{ csrf_field() }}
                
                {{-- Social Login --}}
                {{-- <div class="social">
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
                </div>  --}}
                {{-- // End Social Login --}}       
                {{-- <h4 class="soc"> @lang('loginregister.or') </h4> --}}
                <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">
                </div>
                {{-- Email Login --}}
                <input name="email" type="email" class="form-control" placeholder="Email" required="required"/>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('email') }}</strong>
                </span>
                @endif <br>
                <input name="password" type="password" class="form-control"  placeholder="Password" required="required" /><br>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <label class="checkbox" style="padding: 0px 20px;">
                    <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                </label>
                <button  type="submit" class="btn btn-primary" id="signin">@lang('loginregister.SignIN')</button><br>
                {{-- \\ End Email Login --}}
                {{-- Register LINK --}}
                {{-- <label class="ma" style="padding: 0px 40px;">
                    <span > @lang('loginregister.Needanaccount?') </span>
                    <a href="{{ url('/register') }}"> @lang('loginregister.RegisterHere') </a>
                </label>  --}}
                {{-- \\ End Register LINK --}}  
                {{-- Forgot Password LINK --}}                      
                <label class="forget" style="padding: 10px 0px;">
                    <a class="" href="{{ url('/admin/password/reset') }}">
                        @lang('loginregister.ForgotYourPassword')
                    </a>
                </label>     
                {{-- Forgot Password LINK --}}   
            </form>
        </div>
    </div>

</body>
</html>

    
