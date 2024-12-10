<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ $title ?? 'Dashboard' }} - Bagian Protokol Tulang Bawang</title>
    <link rel="icon"
          type="image/png"
          href="https://upload.wikimedia.org/wikipedia/commons/e/e1/LOGO_KABUPATEN_TULANG_BAWANG.png">
    <!-- CSS files -->
    @stack('lib-css')

    <link href="{{asset('template/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/demo.min.css')}}" rel="stylesheet"/>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    @stack('css')

    @laravelPWA
</head>
<body class="antialiased border-top-wide border-primary d-flex flex-column" style="background-image: url('{{ asset('images/BG-LOGIN-APPS.jpg') }}'); background-size: cover;">
<div class="page page-center">
    @yield('content')
</div>
<!-- Libs JS -->
@stack('lib-js')
<!-- Tabler Core -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('template/js/tabler.min.js')}}"></script>
@stack('js')
</body>
</html>
