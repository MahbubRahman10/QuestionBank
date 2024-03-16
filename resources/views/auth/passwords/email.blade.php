@extends('layouts.master')
@section('title')
    @section('titlename')Forgot Password
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
input#email{
    border-radius: 0px;
}
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2"  style="margin-top: 150px; margin-bottom: 10%;">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('loginregister.resetpassword')</div>

                <div class="panel-body" style="padding: 20px 10px;">
                    @if (session('status'))
                        <div class="alert alert-success" style="margin: 20px 30px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">@lang('loginregister.E-MailAddress')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('loginregister.sendlink')
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
