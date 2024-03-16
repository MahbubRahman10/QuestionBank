@extends('layouts.master')
@section('title')
  @section('titlename')Forum
@endsection
@section('content')
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/forum/index.css') }}">
    <div class="container">
        <div class="question">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8"> 
                        <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" align="center">
                            <thead class="a">
                                <tr align="center">
                                  <td class="thead" width="45%" align="left"></td>
                                  <td class="thead" width="20%">@lang('forum.category')</td>
                                  <td class="thead">@lang('forum.view')</td>
                                  <td class="thead">@lang('forum.reply')</td>
                              </tr>
                              <?php 
                              $lang =  LaravelLocalization::getCurrentLocale();
                              use Carbon\Carbon;
                              Carbon::setLocale($lang);
                              $english =array('0','1','2','3','4','5','6','7','8','9');
                              $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
                              ?>
                              @if ($lang == 'bn')
                                <style type="text/css">
                                .tborder> tbody >tr>td a{
                                  font-size: 18px;
                                }
                                  .tborder> tbody >tr>td p {
                                    font-size: 17px;
                                  }
                                </style>
                              @endif
                          </thead>
                          @foreach ($question as $value)
                          <tbody id="coll" style="">                                      
                            <tr align="center" class="abc">                                 
                                <td class="main-link" colspan="0" align="left">                                         
                                    <a class="title" href="/forum/view/{{$value->id}}">{{ $value->title }}</a>
                                    @if ($lang == 'en')
                                      <p>@lang('forum.time') {{ Carbon::parse($value->created_at)->diffForHumans() }} </p>
                                    @else
                                      <p>@lang('forum.time') {{ str_replace($english, $bangla,Carbon::parse($value->created_at)->diffForHumans()) }} </p>
                                    @endif
                                </td>
                                <td class="category">
                                    <a>{{ $value->category }}</a>
                                </td>
                                <td>
                                    @if ($lang == 'en')
                                      <a> {{ $value->visitor }} </a>
                                    @else
                                      <a> {{ str_replace($english, $bangla,$value->visitor) }} </a>
                                    @endif
                                </td>
                                <td class="num_views">
                                    @if ($lang == 'en')
                                      <a> {{ $value->num_reply }} </a>
                                    @else
                                      <a> {{ str_replace($english, $bangla,$value->num_reply) }} </a>
                                    @endif
                                </td>                                                   
                            </tr>                                   
                        </tbody>
                        @endforeach
                    </table>

                    {{  $question->links() }}
                    </div>
                    <div class="col-md-4">
                      @include('forum.side')
                    </div>
                </div>
            </div>
        </div>  
    </div>  

@endsection