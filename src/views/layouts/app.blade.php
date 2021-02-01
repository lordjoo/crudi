<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('crudi.site_name') }}  @stack('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('vendor/crudi/css/all.css')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/crudi/css/bootstrap.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('vendor/crudi/css/mdb.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{asset('vendor/crudi/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/crudi/css/addons/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/crudi/sw/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/crudi/css/custom.css')}}">
    <style>

        .map-container{
            overflow:hidden;
            padding-bottom:56.25%;
            position:relative;
            height:0;
        }
        .map-container iframe{
            left:0;
            top:0;
            height:100%;
            width:100%;
            position:absolute;
        }
    </style>
    <link rel="icon" href="{{ config('crudi.favicon_path') }}">
    @stack("css")
</head>

<body class="grey lighten-3">
<!--Main Navigation-->
<header>
    @component('crudi::comp.navbar') @endcomponent
    @component('crudi::comp.sidebar') @endcomponent
</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="pt-5 mx-lg-5">
    @yield('page')
</main>
<!--Main layout-->

<div class="w-100 overlay-nav"></div>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{asset('vendor/crudi/js/jquery-3.4.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('vendor/crudi/js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('vendor/crudi/js/bootstrap.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('vendor/crudi/js/mdb.js') }}"></script>
<script src="{{ asset('vendor/crudi/sw/sweetalert2.js') }}"></script>
<script src="{{ asset('vendor/crudi/js/addons/datatables.js') }}"></script>
<script src="{{ asset('vendor/crudi/js/custom.js') }}"></script>
<script src="{{ asset('vendor/crudi/js/crudi.js') }}"></script>
<!-- Initializations -->
<script>
    new WOW().init();
    @if(session()->has('status') && session()->get('status'))
        Swal.fire("Success",`Your action has been completed successfully`,'success')
    @endif
</script>
@stack('js')
</body>
</html>
