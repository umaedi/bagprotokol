@extends('layouts.template-login')

@section('title', 'Masuk')

@push('css')
    <style>
        .login:before {
            background-image: url("{{ asset('themes-login/images/bg-login-dokumentasi.svg') }}");
        }
    </style>
@endpush

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Bag protokol" class="w-6" src="https://upload.wikimedia.org/wikipedia/commons/e/e1/LOGO_KABUPATEN_TULANG_BAWANG.png">
                    <span class="text-white text-lg ml-3"> Seru<span class="font-medium">IT</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="Icewall Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo_dokumentasi']) }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
{{--                        Sistem Dokumentasi--}}
                    </div>
                    <div class="-intro-x mt-5 capitalize text-lg text-white text-opacity-70 dark:text-gray-500">Sistem Dokumentasi Daerah</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        <img src="{{ asset('images/SIDOKPIM-NEW.png') }}" class="mb-5 mx-auto block sm:hidden" style="height: 100px!important;">
                        Masuk <small>ke</small> Aplikasi Dokumentasi
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Silahkan gunakan akun anda yang telah terdaftar</div>
                    <div class="intro-x mt-8">
                        <div class="input-form @error('username') has-error @enderror">
                            <input name="username" value="{{ old('username') }}" type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" placeholder="Username">
                            @error('username')
                            <small class="pristine-error text-theme-24 mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="input-form @error('password') has-error @enderror">
                            <input name="password" type="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password">
                            @error('password')
                            <small class="pristine-error text-theme-24 mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input id="remember-me" type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}} class="form-check-input border mr-2">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <a href="{{ url('password/reset') }}">Lupa Password?</a>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="btn btn-success py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                        {{--<a href="{{ url('register') }}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Sign up</a>--}}
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </form>
@endsection
