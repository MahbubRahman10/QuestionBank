@extends('layouts.master')

@section('title')
@section('titlename')Confirmation
@endsection
@section('content')

<style type="text/css">
.panel-default>.panel-heading {
  color: #333;
  font-size: 18px;
  background-color: #f5f5f5;
  border-color: #ddd;
}
.panel-body {
    background: #fafafa;
}
</style>

<br><br><br>

<br><br><br>

<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">@lang('loginregister.confirmation')!</div>
        <div class="panel-body">
          <h1> @lang('loginregister.thanku')</h1>
          <p>
          @lang('loginregister.confirmationmsg')</a>
        </p>
      </div>
    </div>
  </div>
</div>
</div>

<br><br><br><br><br><br><br>

<script type="text/javascript">
  $(document).ready(function() {
    window.history.pushState(null, "", window.location.href);        
    window.onpopstate = function() {
      window.history.pushState(null, "", window.location.href);
    };
  });
</script>




@endsection