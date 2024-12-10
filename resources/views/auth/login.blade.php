@extends('layouts.auth')

@section('content')
    <div class="container py-4">
        {{--<div class="text-center mb-4">
            <a href="."><img onerror="this.src = 'https://via.placeholder.com/350x65.png/CCCCCC/FFFFFF/?text={{$settings['app_name']}}'" src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo'])  }}" height="100" alt=""></a>
        </div>
        <form class="card card-md" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card-body">
                <div class="text-center">
                    <img src="https://www.btklsby.go.id/images/placeholder/nogender.png" alt="" class="avatar avatar-lg rounded-circle">
                </div>
                <h1 class="text-center">LOGIN</h1>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input autocomplete="" name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username">
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @endif
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                        --}}{{--<span class="form-label-description">
                  <a href="#">Saya lupa password</a>
                </span>--}}{{--
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
                        --}}{{--<span class="input-group-text">
                          <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                          </a>
                </span>--}}{{--
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input checked name="remember" type="checkbox" class="form-check-input"/>
                        <span class="form-check-label"><b>Ingat Login</b></span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    <button type="button" id="installApp" class="btn btn-success w-100 mt-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google-play" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 3.71v16.58a0.7 .7 0 0 0 1.05 .606l14.622 -8.42a0.55 .55 0 0 0 0 -.953l-14.622 -8.419a0.7 .7 0 0 0 -1.05 .607z" />
                            <line x1="15" y1="9" x2="4.5" y2="20.5" />
                            <line x1="4.5" y1="3.5" x2="15" y2="15" />
                        </svg>Install Aplikasi</button>
                </div>
            </div>
        </form>--}}
        {{--<div class="text-center text-muted mt-3">
            Don't have account yet? <a href="./sign-up.html" tabindex="-1">Sign up</a>
        </div>--}}

        <div class="row">
            <div class="col-12 mb-2 text-center ">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/LOGO_KABUPATEN_TULANG_BAWANG.png" width="75px" class="mb-2">
                <h1 class="text-white">PILIH APLIKASI</h1>
            </div>
            <div class="col-md-4 mb-2 text-center card-app">
                <a href="{{ url('/login-agenda') }}" class="text-decoration-none">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo_agenda']) }}" height="400px" width="400px" class="rounded">
                </a>
            </div>
            <div class="col-md-4 text-center mb-2 card-app">
                <a href="{{ url('login-seruit') }}" class="text-decoration-none">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo_seruit']) }}" height="400px" width="400px" class="rounded">
                </a>
            </div>
            <div class="col-md-4 text-center mb-2 card-app">
                <a href="{{ url('login-dokumentasi') }}" class="text-decoration-none">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo_dokumentasi']) }}" height="400px" width="400px" class="rounded">
                </a>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
    <script>
        const animateCSS = (element, animation, prefix = 'animate__') =>
            // We create a Promise and return it
            new Promise((resolve, reject) => {
                const animationName = `${prefix}${animation}`;
                const node = element;

                node.addClass(`${prefix}animated `+ animationName);

                // When the animation ends, we clean the classes and resolve the Promise
                function handleAnimationEnd(event) {
                    event.stopPropagation();
                    node.removeClass(`${prefix}animated ` + animationName);
                    resolve('Animation ended');
                }

                node.one('animationend', handleAnimationEnd);
            });

        $(document).ready(function () {
            $('.card-app').mouseenter(function() {
                animateCSS($(this), 'tada');
            })
        })
    </script>
@endpush
