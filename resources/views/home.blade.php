<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


{{--    Custom Theme CSS     --}}
<!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}">
    <link rel="icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="{{asset('assets/vendors/vectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" type="text/css" />

    <!-- Data Table CSS -->
    <link href="{{asset('assets/vendors/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Toggles CSS -->
    <link href="{{asset('assets/vendors/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

    <!-- Toastr CSS -->
    <link href="{{asset('assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{asset('assets/dist/css/style.css?v=1')}}" rel="stylesheet" type="text/css">

    <script defer src="{{asset('js/app.js')}}"></script>

    <!-- jQuery -->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{asset('assets/dist/js/feather.min.js')}}"></script>

</head>
<body>
<div id="app">
    <app></app>
</div>
</body>
</html>
