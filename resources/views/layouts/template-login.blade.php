<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <meta name="author" content="#">
    <title>@yield('title') - Bagian Protokol Tulang Bawang</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('themes-login/css/app.css')}}" />
    <!-- END: CSS Assets-->

    @stack('css')
    @laravelPWA
</head>
<!-- END: Head -->
<body class="login">
<div class="container sm:px-10">
    @yield('content')
</div>
<!-- END: Dark Mode Switcher-->
<!-- BEGIN: JS Assets-->
<script src="{{asset('themes-login/js/app.js')}}"></script>
<!-- END: JS Assets-->
</body>
</html>
