<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css')}}">
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="{{asset('vendors/swiper-master/css/swiper.min.css')}}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css')}}">
    <!-- Metismenu -->
    <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.min.css')}}">
    <!-- Apex chart -->
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.scrollbar.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dropify.min.css')}}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

    <!-- Site Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css')}}">
    <!-- Modernizr Js -->
    <script src="{{asset('vendors/modernizr-js/modernizr.js')}}"></script>
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <style>
        .alert {
            margin-bottom: 0px !important;
            border-radius: 0px !important;
        }
    </style>
</head>
<body class="text-left nimmu-bg user-bg">
    @yield('styles')
    @if(Session::has('success'))
        <div class="alert-float alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{Session::get('success')}}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert-float alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{Session::get('error')}}
        </div>
    @endif
    @if(!empty($errors) && count($errors) > 0)
        <div class="alert-float alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{$errors->first()}}
        </div>
    @endif

    {{--Region Content--}}
    @yield('content')

    <script src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script> <script src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <!-- Owl Carousel -->
    <script src="{{asset('asset/js/owl.carousel.min.js')}}"></script>
    <!-- Counterup -->
    <script src="{{asset('asset/js/waypoints.min.js')}}"></script>
    <script src="{{asset('asset/js/counterup.min.js')}}"></script>
    <!-- Slicknav -->
    <script src="{{asset('asset/js/jquery.slicknav.min.js')}}"></script>
    <!-- magnific popup -->
    <script src="{{asset('asset/js/magnific-popup.min.js')}}"></script>
    <!-- Swiper Slider -->
    <script src="{{asset('vendors/swiper-master/js/swiper.min.js')}}"></script>
    <!-- Metismenu -->
    <script src="{{asset('asset/js/metisMenu.min.js')}}"></script>
    <!-- scroll bar -->
    <script src="{{asset('asset/js/jquery.scrollbar.min.js')}}"></script>

    <script src="{{asset('asset/js/sweetalert2.all.min.js')}}"></script>

    <!-- text editor -->
    <script type="text/javascript" src="{{asset('vendors/editor/js/froala_editor.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/align.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/char_counter.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/code_beautifier.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/code_view.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/colors.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/draggable.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/emoticons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/entities.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/file.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/font_size.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/font_family.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/fullscreen.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/image.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/image_manager.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/line_breaker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/inline_style.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/link.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/lists.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/paragraph_format.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/paragraph_style.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/quick_insert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/quote.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/table.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/save.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/url.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/video.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/help.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/third_party/spell_checker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/special_characters.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/editor/js/plugins/word_paste.min.js')}}"></script>


    <!-- main js -->
    <script src="{{asset('asset/js/scripts.js')}}"></script>

    <script>

        (function () {
            new FroalaEditor("#edit")
        })()

    </script>
    @yield('scripts')
</body>

</html>
