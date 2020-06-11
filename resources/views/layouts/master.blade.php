<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="html5 responsive bootstrap template">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript,html5,css3, responsive, bootstrap,jquery,">
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
    @yield('style')

</head>

<body class="nimmu-bg text-left">
<div class="app-admin-wrap layout-sidebar-large">
    @if (Auth::user()->role == SUPER_ADMIN_ROLE)
        @include('super_admin.sidebar')
    @elseif (Auth::user()->role == ADMIN_ROLE)
        @include('admin.sidebar')
    @endif
    <div class="nimmu-wrapper">
        @include('layouts.header')
        <div class="alert-float alert" id="alert" style="display: none">
            <button type="button" class="close" id="alertRemove" aria-hidden="true">x</button>
            <span class="message"></span>
        </div>
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
        @yield('content')
    </div>
</div>

<!-- ============ Search UI End ============= -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Owl Carousel -->
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<!-- Counterup -->
<script src="{{asset('assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counterup.min.js')}}"></script>
<!-- Slicknav -->
<script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('assets/js/magnific-popup.min.js')}}"></script>
<!-- Swiper Slider -->
<script src="{{asset('vendors/swiper-master/js/swiper.min.js')}}"></script>
<!-- Metismenu -->
<script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
<!-- scroll bar -->
<script src="{{asset('assets/js/jquery.scrollbar.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


<!-- main js -->
<script src="{{asset('assets/js/scripts.js')}}"></script>
{{--<script src="{{asset('assets/js/dropzone.script.js')}}"></script>--}}
@yield('script')
<script>
    $(document).on("click", ".confirmedDelete", function() {
        var link = $(this).data("link");
        jQuery.confirm({
            content: '{{ __('Do you really want to delete?') }}',
            title: '{{ __('Confirmation') }}',
            buttons: {
                confirm: {
                    text: '{{ __('Yes') }}',
                    keys: ['enter'],
                    action: function(){
                        window.location.replace(link);
                    }
                },
                cancel: {
                    text: '{{ __('No') }}',
                    keys: ['esc'],
                    action: function(){
                    }
                }
            }
        });
    });
    $('#alertRemove').click(function () {
        $('#alert').hide();
    });

    $('document').ready(function () {
        $('#dropdown').on('click', function () {
            if(!$('#dropdown-option').hasClass('show')){
                $('#dropdown-option').addClass('show');
            }
            else if($('#dropdown-option').hasClass('show')){
                $('#dropdown-option').removeClass('show');
            }
        })
    });
</script>
</body>

</html>
