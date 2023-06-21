<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="" />
    <!-- BEGIN: Page Title-->
    <title>@yield('title') - Order App</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('/') }}">
    {{-- css --}}
    <!-- BEGIN: Custom CSS-->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link type="image/x-icon" rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/jquery.growl/jquery.growl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css')
    <script src="{{ asset('assets/js/plugin-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/adata-init.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.growl/jquery.growl.js') }}"></script>
    <!-- END: Global JS-->

</head>

<body>
    <div id="spinner" style="display:none;">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
    <!--================================-->
    <!-- Page Container Start -->
    <!--================================-->
    @yield('content')
    <!--/ Page Container End -->
    @include('admin.layouts.partials.setting')
    @include('admin.layouts.partials.message')
    @yield('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>
