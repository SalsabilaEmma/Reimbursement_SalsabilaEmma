<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mars Office">
    <meta name="keywords" content="Mars Office">
    <meta name="author" content="pixelstrap">
    <meta name="cuba-url" content="{{ url('cuba') }}">
    <link rel="icon" href="{{ url('image') }}/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('image') }}/logo.png" type="image/x-icon">
    <title>Reimbursement Project - Salsabila Emma</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('cuba') }}/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/responsive.css">

    {{-- @section('css')
    @show --}}
    @yield('css')
</head>

<body onload="startTime()">
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layout.header')
        <!-- Page Header Ends -->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <div class="sidebar-wrapper">
                <!-- Page Sidebar Start-->
                @include('layout.sidebar')
                <!-- Page Sidebar Ends-->
            </div>

            <!-- Page Content Start-->
            @yield('content')
            <!-- Page Content Ends-->

            <!-- footer start-->
            @include('layout.footer')
            <!-- footer Ends-->

        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ url('cuba') }}/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ url('cuba') }}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ url('cuba') }}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="{{ url('cuba') }}/assets/js/scrollbar/simplebar.js"></script>
    <script src="{{ url('cuba') }}/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ url('cuba') }}/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ url('cuba') }}/assets/js/sidebar-menu.js"></script>
    <script src="{{ url('cuba') }}/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/chart/chartist/chartist.js"></script>
    <script src="{{ url('cuba') }}/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="{{ url('cuba') }}/assets/js/chart/knob/knob.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/chart/knob/knob-chart.js"></script>
    <script src="{{ url('cuba') }}/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="{{ url('cuba') }}/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="{{ url('cuba') }}/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{ url('cuba') }}/assets/js/dashboard/default.js"></script>
    <script src="{{ url('cuba') }}/assets/js/notify/index.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="{{ url('cuba') }}/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="{{ url('cuba') }}/assets/js/typeahead/handlebars.js"></script>
    <script src="{{ url('cuba') }}/assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="{{ url('cuba') }}/assets/js/typeahead/typeahead.custom.js"></script>
    <script src="{{ url('cuba') }}/assets/js/typeahead-search/handlebars.js"></script>
    <script src="{{ url('cuba') }}/assets/js/typeahead-search/typeahead-custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ url('cuba') }}/assets/js/script.js"></script>
    {{-- <script src="{{ url('cuba') }}/assets/js/theme-customizer/customizer.js"></script> --}}
    <!-- login js-->
    <!-- Plugin used-->
    {{-- @show --}}
    @yield('js')
</body>

</html>
