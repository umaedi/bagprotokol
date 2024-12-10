<!-- top bar start -->
<section class="top-bar v5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 align-self-center">
                @include('fronts.layout.breaking-news')
            </div>
            <!-- end col-->

            <div class="col-md-4 text-right xs-left">
                <div class="ts-date-item" style="cursor: pointer" id="installApp">
                    <i class="fa fa-android"></i>
                    Install Aplikasi
                </div>
            </div>
            <!--end col -->

        </div>
        <!-- end row -->
    </div>
</section>
<!-- end top bar-->
<header class="navbar-standerd">
    <div class="container">
        <div class="row">

            <!-- logo end-->
            <div class="col-lg-12">
                <!--nav top end-->
                <nav class="navigation ts-main-menu navigation-landscape">
                    <div class="nav-header align-items-center d-flex flex-wrap flex-sm-nowrap">
                        <a class="nav-brand" href="{{ url('/login-seruit') }}">
                            <img style="max-width: 280px; height: 100px" src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo']) }}" alt="">
                        </a>
                        <a class="nav-brand" href="{{ url('/') }}">
                            <img style="max-width: 280px" src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_front_logo']) }}" alt="">
                        </a>
                        <div class="nav-toggle"></div>
                    </div>
                    <!--nav brand end-->

                    <div class="nav-menus-wrapper clearfix">
                        <!--nav right menu start-->
                        <ul class="right-menu align-to-right">
                            <li class="header-search">
                                <div class="nav-search">
                                    <div class="nav-search-button">
                                        <i class="icon icon-search"></i>
                                    </div>
                                    <form action="{{ url('post') }}" method="GET">
                                        <span class="nav-search-close-button" tabindex="0">✕</span>
                                        <div class="nav-search-inner">
                                            <input type="search" name="search" placeholder="Ketik kata kunci lalu tekan ENTER">
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <!--nav right menu end-->

                        <!-- nav menu start-->
                        <ul class="nav-menu align-to-right">
                            <li>
                                <a href="{{ url('/') }}">Beranda</a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ url('dashboard') }}">Dashboard</a>
                                </li>
                            @else
                            <li>
                                <a href="{{ url('login') }}">Login Aplikasi</a>
                            </li>
                            @endauth
                        </ul>
                        <!--nav menu end-->
                    </div>
                </nav>
                <!-- nav end-->
            </div>
        </div>
    </div>
</header>
<!-- header nav end-->
