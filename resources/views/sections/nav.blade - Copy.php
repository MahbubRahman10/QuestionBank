        {{-- Nav page Style Link  --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/head.css') }}">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>


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
            <h2 class="titleimage"> <span > Question Bank</span> </h2>
            <div class="nav">
                <nav>
                    <a href="" class="menu-icon">
                        <i class="fa fa-bars fa-2x" id="icon"></i>
                    </a>       
                    <ul id="menu">
                        <a href="/"><li>  @lang('nav.Home')  </li></a>
                        <a href="/question"><li>  @lang('nav.Question') </li></a>
                        <a href="/exam"><li>  @lang('nav.Exam') </li></a>                        
                        <a href="/about"><li>  @lang('nav.Forum') </li></a>
                        <a href="login"><li> @lang('nav.Login') </li></a>
                        {{-- <a href="register"><li>  @lang('nav.Register') </li></a> --}}
                        <?php
                            $lang =  LaravelLocalization::getCurrentLocale();
                            if ($lang == 'en'){ $localeCode = 'bn'; }else{ $localeCode = 'en'; }
                        ?>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><li>  @lang('nav.lang') </li></a>
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
            });
        </script>