@extends('layouts.master')
@section('title')
    @section('titlename')Reset Password
@endsection
 <style type="text/css">
    .panel-default>.panel-heading {
        color: #333;
        font-size:18px;
        background-color: #f5f5f5;
        border-color: #ddd;
    }
    .panel-body{
        background: #fafafa;
    }
    input#password{
        border-radius: 0px;
    }
    input#password-confirm{
        border-radius: 0px;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-top: 120px; margin-bottom: 5%;">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('loginregister.resetpassword')</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/reset/password">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">@lang('loginregister.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">@lang('loginregister.confirmpassword')</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('loginregister.resetpassword')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
