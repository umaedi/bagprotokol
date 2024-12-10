<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <title>{{ $title ?? 'Home' }} - Bagian Protokol Tulang Bawang Lampung</title>
    <link rel="icon"
          type="image/png"
          href="https://upload.wikimedia.org/wikipedia/commons/e/e1/LOGO_KABUPATEN_TULANG_BAWANG.png">
    <!-- CSS files -->
    @stack('lib-css')
    <link rel="stylesheet" href="{{asset('template-front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/icofonts.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/owlcarousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/navigation.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/colors/color-3.css')}}">
    <link rel="stylesheet" href="{{asset('template-front/css/responsive.css')}}">

    <style>
        @media (min-width: 1200px) {
            .container {
                max-width: 1600px;
            }
        }
    </style>
    @stack('css')
    @laravelPWA
</head>
<body @yield('body-class')>

@yield('content')

<script src="{{asset('template-front/js/jquery.min.js')}}"></script>
<script src="{{asset('template-front/js/navigation.js')}}"></script>
<script src="{{asset('template-front/js/popper.min.js')}}"></script>
<script src="{{asset('template-front/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('template-front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template-front/js/owl-carousel.2.3.0.min.js')}}"></script>
<script src="{{asset('template-front/js/slick.min.js')}}"></script>
<script src="{{asset('template-front/js/smoothscroll.js')}}"></script>
<script src="{{asset('template-front/js/main.js')}}"></script>

@stack('lib-js')

@stack('js')
<script>
    let deferredPrompt;
    window.addEventListener('beforeinstallprompt', (e) => {
        deferredPrompt = e;
    });
    const installApp = document.getElementById('installApp');
    installApp.addEventListener('click', async () => {
        console.log('installing app..')
        if (deferredPrompt !== null) {
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                deferredPrompt = null;
            }
        }
    });
</script>
</body>
</html>
