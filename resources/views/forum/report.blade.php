@extends('layouts.master')
@section('title')
  @section('titlename')Report Reply
@endsection
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/forum/index.css') }}">
    <style type="text/css">
    form input {
     width: 30px;
     height: 14px;
    }
    .report{
          font-size: 18px;
    }
    </style>
    <div class="container">
        <div class="question">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8"> 
                      @if (Session::has('msg'))
                      <div class="alert alert-success" id="alert" style="">
                        <ul>
                          <li style="list-style: none; font-size: 12px; font-weight: bold; color: #3c763d;">{!! Session::get('msg') !!}</li>
                        </ul>
                      </div>
                      <a href="{{ $url }}" class="btn btn-success"> Rigth Back  </a>
                      @endif
                        <h1>Mention why you want take action to this reply?</h1>

                        <form method="post" action="/forum/report/{{ $reply->id }}">
                          <input type="radio" name="report" value="It's annoying"> <span class="report">It's annoying </span><br>
                          <input type="radio" name="report" value="it's is violence"><span class="report"> it's is violence </span><br>
                          <input type="radio" name="report" value="Its' spam"> <span class="report"> Its' spam </span> <br><br>

                          <button type="submit" class="btn btn-primary"> Submit </button>
                          <a href="{{ $url }}" class="btn btn-success"> Cancel </a>

                        </form>

                    </div>
                    <div class="col-md-4">
                      @include('forum.side')
                    </div>
                </div>
            </div>
        </div>  
    </div>  

@endsection