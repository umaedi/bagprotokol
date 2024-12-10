<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            @auth
                <a href="{{ url('/dashboard') }}">
                    <img onerror="this.src = 'https://via.placeholder.com/350x65.png/CCCCCC/FFFFFF/?text={{$settings['app_name']}}'" src="@if(in_array($user['level'], [env('ROLE_SURAT', env('ROLE_USER'))])) {{ \Illuminate\Support\Facades\Storage::url($settings['app_logo'])  }} @elseif(in_array($user['level'], [env('ROLE_PROTOKOL')])) {{ asset('images/SIADIK.png') }} @elseif(in_array($user['level'], [env('ROLE_DOKUMENTASI')])) {{ asset('images/SIDOKPIM-NEW.png') }} @else {{ \Illuminate\Support\Facades\Storage::url($settings['app_logo'])  }} @endif"
                         style="height: 3rem!important;" alt="{{ $settings['app_name'] }}" class="navbar-brand-image">
                </a>

            @else
                <a href="{{ url('/dashboard') }}">
                    <img onerror="this.src = 'https://via.placeholder.com/350x65.png/CCCCCC/FFFFFF/?text={{$settings['app_name']}}'" src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo'])  }}"
                         style="height: 3rem!important;" alt="{{ $settings['app_name'] }}" class="navbar-brand-image">
                </a>
            @endauth
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            {{--<div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href="https://github.com/tabler/tabler" class="btn btn-outline-white" target="_blank"
                       rel="noreferrer">
                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5"/>
                        </svg>
                        Source code
                    </a>
                </div>
            </div>--}}
            @auth
                {{--<div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                       aria-label="Show notifications">
                        <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/>
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1"/>
                        </svg>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur
                                exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet
                                debitis et magni maxime necessitatibus ullam.
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url('{{$user['avatar'] != null ? \Illuminate\Support\Facades\Storage::url($user['avatar']) : 'https://ui-avatars.com/api/?name='.$user['name'] }}')"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ $user['name'] }}</div>
                            <div class="mt-1 small text-muted">{{ \Illuminate\Support\Str::ucfirst($user['level']) }} {{ $user->opd ? '| '. $user->opd->nama_opd : '' }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ url('profile?tab=log') }}" class="dropdown-item">Log Aktivitas</a>
                        <a href="{{ url('profile') }}" class="dropdown-item @if(request()->is('profile*')) active @endif">Profile & account</a>
                        <div class="dropdown-divider"></div>
                        @if($user['level'] == env('ROLE_SUPERADMIN'))
                        <a href="{{ url('setting') }}" class="dropdown-item @if(request()->is('setting*')) active @endif">Settings</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <a href="#" class="dropdown-item" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                        </form>
                    </div>
                </div>
            @else
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item d-none d-md-flex me-3">
                        <div class="btn-list">
                            <a href="{{ url('login') }}" class="btn btn-blue"
                               rel="noreferrer">
                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                    <circle cx="12" cy="16" r="1"></circle>
                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                                </svg>
                                Login
                            </a>
                        </div>
                    </div>
                </div>
                    @endauth
        </div>
    </div>
</header>
