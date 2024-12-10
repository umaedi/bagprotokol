<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - {{ $settings['app_name'] }}</title>
    <link rel="icon"
          type="image/png"
          href="https://upload.wikimedia.org/wikipedia/commons/e/e1/LOGO_KABUPATEN_TULANG_BAWANG.png">
    <!-- CSS files -->
    @stack('lib-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ asset('template/libs/jquery-ui-1.12.1/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libs/jquery-ui-1.12.1/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libs/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/tagsinput.css') }}">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="{{asset('template/css/tabler.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/tabler-flags.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/tabler-payments.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/tabler-vendors.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('template/css/demo.min.css')}}" rel="stylesheet"/>
    @stack('css')
    <style>
        .toast-container{position:fixed;z-index:1055;margin:5px}.top-right{top:0;right:0}.top-left{top:0;left:0}.top-center{transform:translateX(-50%);top:0;left:50%}.bottom-right{right:0;bottom:0}.bottom-left{left:0;bottom:0}.bottom-center{transform:translateX(-50%);bottom:0;left:50%}.toast-container>.toast{min-width:150px;background:0 0;border:none}.toast-container>.toast>.toast-header{border:none}.toast-container>.toast>.toast-header strong{padding-right:20px}.toast-container>.toast>.toast-body{background:#fff}
    </style>
    @laravelPWA
</head>
<body class="antialiased min-vh-100">
<div class="wrapper min-vh-100">
    @include('layouts._header')
    @include('layouts._navbar')
    <div class="page-wrapper">
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            {{ $descTitle ?? 'Overview' }}
                        </div>
                        <h2 class="page-title">
                            {{ $title ?? 'Dashboard' }}
                        </h2>
                        @isset($breadcrumb)
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @foreach($breadcrumb as $bd)
                                <li class="breadcrumb-item @isset($bd['active']) active @endisset">@if(isset($bd['active'])) {{ $bd['name'] }} @else <a href="{{ $bd['url'] }}">{{ $bd['name'] }}</a> @endif</li>
                                @endforeach
                            </ol>
                        </nav>
                        @endisset
                    </div>

                    @yield('action-title')

                </div>
            </div>
        </div>
        <div class="page-body">
            @yield('content')
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{ now()->format('Y') }}
                                <a href="." class="link-secondary">Tabler</a>.
                                All rights reserved. Modified by {{ $settings['app_author'] }}
                            </li>
                            <li class="list-inline-item">
                                <a href="./changelog.html" class="link-secondary" rel="noopener">{{ $settings['app_version'] ?? '1.0.0-beta' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<button type="button" id="scanQR" class="btn btn-lg btn-blue btn-icon position-fixed" aria-label="Scan QRCode" style="right: 20px; bottom: 20px;">
    <!-- Download SVG icon from http://tabler-icons.io/i/brand-youtube -->
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
        <path d="M4 17v1a2 2 0 0 0 2 2h2" />
        <path d="M16 4h2a2 2 0 0 1 2 2v1" />
        <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
        <line x1="5" y1="12" x2="19" y2="12" />
    </svg>
</button>
<div class="modal modal-blur fade" id="modal-full-width" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">SCAN QR CODE SURAT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <canvas class="w-50" id="qr-canvas"></canvas>
                <span id="outputData"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" id="reScan">Scan Ulang</button>
                <a href="#" class="btn btn-primary" id="openLink" style="display: none">Kunjungi Link</a>
            </div>
        </div>
    </div>
</div>
<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/js/toast.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('template/libs/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{ asset('assets/js/tagsinput.js') }}"></script>
<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js">
</script>
@stack('lib-js')
<!-- Tabler Core -->
<script src="{{asset('template/js/tabler.min.js')}}"></script>
<script>

    // const qrcode = window.qrcode;

    const video = document.createElement("video");
    const canvasElement = document.getElementById("qr-canvas");
    const canvas = canvasElement.getContext("2d");

    let scanning = false;
    qrcode.callback = (res) => {
        if (res) {
            scanning = false;
            $('#openLink').prop('href', res);
            $('#openLink').show()

            video.srcObject.getTracks().forEach(track => {
                track.stop();
            });
        }
    };

    $(document).ready(function () {
        // initToast('Berhasil', 'Dokumen berhasil dihapus!', 'success', '11 menit yang lalu')
        $('.select2').select2({
            placeholder: 'Pilih data'
        });
        $('#modal-full-width').modal({
            backdrop: 'static'
        })
        $('#qr-canvas').on('hide.bs.modal', function () {
            scanning = false;
            video.srcObject.getTracks().forEach(track => {
                track.stop();
            });
        })
        $('#reScan').click(function () {
            startCamera()
            $('#openLink').hide()
        })
        $('#scanQR').click(function () {
            startCamera()
        })
    })

    function startCamera() {
        $('#modal-full-width').modal('show')
        navigator.mediaDevices
            .getUserMedia({ video: { facingMode: "environment" } })
            .then(function(stream) {
                scanning = true;
                $('#qr-canvas').show()
                video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                video.srcObject = stream;
                video.play();
                tick();
                scan();
            });
    }

    function tick() {
        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

        scanning && requestAnimationFrame(tick);
    }
    function scan() {
        try {
            qrcode.decode();
        } catch (e) {
            setTimeout(scan, 300);
        }
    }

    function initToast(title, message, status, time) {
        $.toast({
            type: status,
            title: title,
            subtitle: time,
            content: message,
            delay: 5000,
        });
    }

    async function transAjax(data) {
        html = null;
        data.headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        await $.ajax(data).done(function(res) {
            html = res;
        })
            .fail(function() {
                return false;
            })
        return html
    }

    function initMagnific() {
        $('.image-link').magnificPopup({
            type: 'image',
            mainClass: 'mfp-with-zoom', // this class is for CSS animation below

            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it

                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function

                // The "opener" function should return the element from which popup will be zoomed in
                // and to which popup will be scaled down
                // By defailt it looks for an image tag:
                opener: function(openerElement) {
                    // openerElement is the element on which popup was initialized, in this case its <a> tag
                    // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }

        });
    }

</script>
@stack('js')
</body>
</html>
