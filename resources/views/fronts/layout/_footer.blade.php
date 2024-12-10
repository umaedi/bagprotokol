<!-- footer social list start-->
<section class="ts-footer-social-list section-bg pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-3">
                <div class="footer-logo">
                    <a href="{{ url('/login-seruit') }}">
                        <img style="max-width: 250px"
                             src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_logo']) }}"
                             height="100px"
                             alt="">
                    </a>
                    <a href="{{ url('/') }}">
                        <img style="max-width: 250px"
                             src="{{ \Illuminate\Support\Facades\Storage::url($settings['app_front_logo']) }}"
                             alt="">
                    </a>
                </div>
                <!-- footer logo end-->
            </div>
            <!-- col end-->

            <div class="col-lg-12 text-center justify-content-center align-items-center d-flex">
                <ul class="footer-social">
                    <li class="ts-facebook">
                        <a href="{{ $settings['app_fb'] }}">
                            <i class="fa fa-facebook"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li class="ts-pinterest">
                        <a href="{{ $settings['app_yt'] }}">
                            <i class="fa fa-youtube"></i>
                            <span>Youtube</span>
                        </a>
                    </li>
                    <li class="ts-pinterest">
                        <a href="{{ $settings['app_ig'] }}">
                            <i class="fa fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- col end-->

        </div>
    </div>
</section>
<!-- footer social list end-->
<footer class="ts-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-menu text-center">
                    <ul>
                        <li>
                            <a href="#">Link Terkait</a>
                        </li>
                        <li>
                            <a href="#">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="#">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
                <div class="copyright-text text-center">
                    <p>&copy; {{ now()->format('Y') }} Bag. Protokol Sekretariat Daerah Tulang Bawang. All rights reserved</p>
                </div>
            </div><!-- col end -->
        </div><!-- row end -->
        <div id="back-to-top" class="back-to-top">
            <button class="btn btn-primary" title="Back to Top">
                <i class="fa fa-angle-up"></i>
            </button>
        </div><!-- Back to top end -->
    </div><!-- Container end-->
</footer>
<!-- footer end -->
