       
        {{-- Meta Tag  --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewpost" content="width=device-width, initial-scale: 1.0, user-scalabe=0">
        <meta name="lang" id="lang" content="{{ LaravelLocalization::getCurrentLocale() }}">

        <link rel="icon" type="image/png" href="{{ asset('img/question.jpg') }}">

        {{-- Bootstrap CSS & JS link  --}}
        <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

        {{-- Animate CSS link  --}}
        <link rel="stylesheet" href="{{ asset('css/animate/animate.css') }}">

        {{-- Jquery Link  --}}  
        <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

        {{-- Font Awesome Link  --}}
        <link rel="stylesheet" href="{{ asset('fonts/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        {{-- Font Link --}}
        <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
        <link href="https://fonts.maateen.me/bangla/font.css" rel="stylesheet">

        {{-- Font Link --}}
        <link href="{{ asset('/fonts/kal.css') }}" rel="stylesheet">
        <link href="{{ asset('/fonts/bangla.css') }}" rel="stylesheet">

        {{-- IONICONS --}}
        <link href="/fonts/ionicons.css" rel="stylesheet" type="text/css" />

        {{-- print --}}
        <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print" type="text/css">

        {{-- CSRF Token  --}}
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                ]); ?>

        </script>

        {{-- Site Title  --}}
        @yield('title')

