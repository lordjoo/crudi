<!DOCTYPE html>
<html lang="en" dir="{{ config('crudi.is_trl',false)?"":"rtl" }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('crudi.site_name') }}  @stack('title')</title>
    <!-- Font Awesome -->
    <link href="{{ asset('/vendor/crudi/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/crudi/css/custom.css') }}" rel="stylesheet">
    <link href="{{asset('vendor/crudi/datatables/datatables.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/crudi/sw/sweetalert2.css')}}" rel="stylesheet">

    <!--- MDI Icon -->
    <link rel="stylesheet" href="{{ asset('vendor/crudi/css/materialdesignicons.min.css') }}">

    <link href="{{ config('crudi.favicon_path') }}" rel="icon">
    @stack("css")
</head>

<body class="c-app @if(config('crudi.dark_default',true)) c-dark-theme @endif">
@component('crudi::comp.sidebar') @endcomponent


<div class="c-wrapper c-fixed-components">
    @component('crudi::comp.navbar') @endcomponent

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $er)
                            {{ $er }} <br>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="container-fluid">
                <div class="fade-in">
                    @yield('page')
                </div>
            </div>
        </main>

        <footer class="c-footer">
            <div>Powered by Crudi | {{ config('crudi.site_name') }} © {{ date('Y') }}.</div>
        </footer>
    </div>
</div>


<script src="{{ asset('vendor/crudi/js/jquery-3.4.1.min.js') }}"></script>
<!-- CoreUI and necessary plugins-->
<script src="{{ asset('vendor/crudi/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>

<!--<![endif]-->
<script src="{{ asset('vendor/crudi/sw/sweetalert2.js') }}"></script>
<script src="{{ asset('vendor/crudi/datatables/datatables.js') }}"></script>
<script src="{{ asset('vendor/crudi/js/crudi.js') }}"></script>
<!-- Initializations -->
<script>
    @if(session()->has('status') && session()->get('status'))
    Swal.fire("@lang('crudi::main.success')", `@lang("crudi::main.action_done")`, 'success')
    @endif

    @if($errors->any())
    Swal.fire("@lang('crudi::main.whoopse')","@foreach($errors->all() as $err){{ $err }} \n @endforeach", 'error')
    @endif
</script>
@stack('js')
</body>
</html>
