        {{-- Nav page Style Link  --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/head.css') }}">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

        {{-- Title --}}
        <title> @yield('titlename') | {{ $siteoption->subtitle }} </title>

        <style type="text/css">
        .titleimage:after {
        	content : "{{ $siteoption->title }}";
        	color: #d1d1d1;
        	text-shadow: 0 1px 0 white;
        }

        </style>

        {{-- <div id="nav-head">
            <div class="head-logo">

                <
            </div>

            <div class="head-detail">
                <ul>
                    <a href=""> <li>Login</li> </a>
                </ul>
            </div>
        </div>   --}}

        {{-- Header --}}
        <header>            
            <h2 class="titleimage"> <a href="/"><span > {{ $siteoption->title }} </span></a> </h2>
            <div class="nav">
                <nav>
                    <a href="" class="menu-icon">
                        <i class="fa fa-bars fa-2x" id="icon"></i>
                    </a>       
                    <ul id="menu">
                        <a href="/"><li>  @lang('nav.Home')  </li></a>
                        <a href="/questions"><li>  @lang('nav.Question') </li></a>
                        <a href="/exam"><li>  @lang('nav.Exam') </li></a>   
                        <a href="/question/archive"><li>  @lang('nav.Archive') </li></a>                     
                        <a href="/forum"><li>  @lang('nav.Forum') </li></a>
                        <a href="/search"><li>  @lang('index.Search') </li></a>
                        
                        <div class="nav-right">
                            @auth()                            
                                <div class="user-dropdown">
                                    <a rel="alternate" href="#" class="user-dropdown-a"><li class="user">  @lang('nav.user') <i class="fa fa-angle-down"></i> </li>
                                        <ul id="user-sub-menu">
                                            <a rel="alternate" href="/user/profile"><li>@lang('nav.profile')</li></a>
                                            <a rel="alternate" href="/forum/ask"><li>@lang('nav.ask')</li></a>
                                            <a rel="alternate" href="/logout"><li>@lang('nav.logout')</li></a>
                                        </ul>

                                    </a>
                                </div>
                            @else
                                <a href="/login" class="login"><li> @lang('nav.Login') </li></a>
                            @endauth
                            <?php
                                $lang =  LaravelLocalization::getCurrentLocale();
                                if ($lang == 'en'){ $localeCode = 'bn'; }else{ $localeCode = 'en'; }
                            ?>
                            {{-- <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><li>  @lang('nav.lang') <i class="fa fa-angle-down"></i> </li></a> --}}
                            @if ($lang == 'bn')
                              <style type="text/css">
                                body{
                                    font-family: 'kalpurush', sans-serif;
                                }
                                .nav .nav-right .user-dropdown ul a li {
                                    background: none;
                                    color: #333333;
                                    font-weight: normal;
                                    font-size: 15px;
                                }
                               
                              </style>
                            @endif
                            <div class="dropdown">
                                <a rel="alternate" href="#" class="dropdown-a"><li> @lang('nav.lang') <i class="fa fa-angle-down"></i> </li>

                                    <ul id="sub-menu">
                                        @if ($lang == 'en')
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><li>বাংলা</li></a>
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"><li>English</li></a>
                                        @elseif($lang == 'bn')
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL('bn', null, [], true) }}"><li>বাংলা</li></a>
                                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><li>English</li></a>
                                        @endif
                                    </ul>
                                </a>
                            </div>

                            @auth
                            <div class="notification-dropdown">
                                <a  class="notification-dropdown-a">
                                    <li>  <i class="fa fa-bell">@if($unseennotification != 0) <span class="notification-number">{{ $unseennotification  }}</span> @endif</i>   </li>
                                    <ul id="notification-sub-menu">

                                        <section class="notification">
                                            <h2 class="notification-tag" >
                                                @lang('nav.notification')({{ count($notifications) }})
                                            </h2>
                                            <h2 class="notification-viewall">
                                                <a href="/notifications" style="background: none">@lang('nav.viewall')</a>
                                            </h2>
                                        </section>
                                        @if(count($notifications) == '0')
                                            <p class="nonenotification">You have no notifications</p>
                                            <style type="text/css">
                                                .nav .nav-right .notification-dropdown ul{
                                                    height: 100px;
                                                }
                                            </style>
                                        @else
                                        @foreach ($notifications as $notification)
                                        <section class="notification-list" @if($notification->seen == 0) id="notification-list-unseen"  @endif>
                                            <a href="/notification/view/{{ $notification->id }}">
                                                <p class="notification-message">
                                                 {{ $notification->notification }}     
                                             </p>
                                             <p style="color: #90949c;"> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }} <p>
                                             </a>
                                         </section>
                                         @endforeach
                                         @endif
                                     </ul>

                                </a>
                            </div>
                            @endauth

                        </div>

                    </ul>    
                </nav>
            </div>
        </header>

        {{-- Header mobile menu script  --}}
        <script type="text/javascript"> 
            $(document).ready(function(){
                $('.menu-icon').on('click', function(e){
                    e.preventDefault();
                    var check = $("#menu").hasClass("showing");
                    if(check == false){
                        $("#menu").addClass("showing");
                        $(".showing").css("display","block");
                    }
                    else{
                        $("#menu").removeClass("showing");
                    }
                });

                // Language Menu
                $('.dropdown-a').on('click', function(e){
                    e.preventDefault();
                    var check = $("#sub-menu").hasClass("sub-showing");
                    if(check == false){
                        $("#user-sub-menu").removeClass("user-sub-showing");
                        $("#sub-menu").addClass("sub-showing");
                        $(".sub-showing").css("display","block");
                    }
                    else{
                        $("#sub-menu").removeClass("sub-showing");
                    }
                });

                // User Menu
                $('.user-dropdown-a').on('click', function(e){
                    e.preventDefault();
                    var check = $("#user-sub-menu").hasClass("user-sub-showing");
                    if(check == false){
                        $("#sub-menu").removeClass("sub-showing");                        
                        $("#user-sub-menu").addClass("user-sub-showing");                        
                        $(".user-sub-showing").css("border-bottom","1px solid #bbb");
                        $(".user-sub-showing").css("display","block");
                    }
                    else{
                        $(".user-sub-showing").css("border-bottom","0px solid #bbb");
                        $("#user-sub-menu").removeClass("user-sub-showing");
                    }
                });

                // Notification Menu
                $('.notification-dropdown-a').on('click', function(e){
                    e.preventDefault();
                    $(".user-sub-showing").css("border-bottom","0px solid #bbb");
                     $("#user-sub-menu").removeClass("user-sub-showing");
                    var check = $("#notification-sub-menu").hasClass("notification-sub-showing");
                    if(check == false){
                        $("#sub-menu").removeClass("sub-showing");                       
                        $("#notification-sub-menu").addClass("notification-sub-showing");
                        $(".notification-sub-showing").css("border-bottom","1px solid #bbb");
                        $(".notification-sub-showing").css("display","block");
                    }
                    else{
                        $(".notification-sub-showing").css("border-bottom","0px solid #bbb");
                        $("#notification-sub-menu").removeClass("notification-sub-showing");
                    }
                });

            });


            window.onclick = function(event) {
                  console.log(event.target)

                if (event.target.matches('.user')) {
                    event.stopPropagation();
                    $(".notification-sub-showing").css("border-bottom","0px solid black");
                    $("#notification-sub-menu").removeClass("notification-sub-showing");
                }
                else if (event.target.matches('#notification-sub-menu li')) {
                    event.stopPropagation();

                }
                else if (event.target.matches('.notification-dropdown li') || event.target.matches('.fa-bell') || event.target.matches('.notification-number')) {
                    var check = $("#notification-sub-menu").hasClass("notification-sub-showing")
                    if (check == false) {
                       
                    }
                }
                else if(event.target.matches('.notification-viewall') || event.target.matches('.notification-tag') || event.target.matches('.notification')){
                    event.preventDefault();
                    var check = $("#notification-sub-menu").hasClass("notification-sub-showing")
                    
                }
                else{
                    $(".notification-sub-showing").css("border-bottom","0px solid #eee");
                    $("#notification-sub-menu").removeClass("notification-sub-showing");
                    $(".user-sub-showing").css("border-bottom","0px solid #bbb");
                    $("#user-sub-menu").removeClass("user-sub-showing");
                }
            }




        </script>