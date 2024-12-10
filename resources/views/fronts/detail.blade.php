@extends('fronts.layout.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('body-class', 'body-color')

@section('content')
    @include('fronts.layout.header')
    <section class="single-post-wrapper post-layout-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-big-img mb-30" style="background-image: url('{{ \Illuminate\Support\Facades\Storage::url($post->picture) }}')">

                        <div class="entry-header">
                            <div class="category-name-list">
								<span>
									@foreach($post->kategori as $kt)
                                        <a href="{{ url('post/kategori/'. $kt->label) }}" class="post-cat ts-pink-bg">{{ $kt->label }}</a>
                                    @endforeach
								</span>
                            </div>
                            <h2 class="post-title lg">{{ $post->title }}</h2>
                            <ul class="post-meta-info">
                                <li class="author">
                                    <a href="#">
                                        <img src="https://ui-avatars.com/api/?name=Administrator" alt=""> Administrator
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-clock-o"></i>
                                        {{ \Carbon\Carbon::parse($post->tanggal)->isoFormat('MMMM, D YYYY') }}
                                    </a>
                                </li>
                                {{--<li>
                                    <a href="">
                                        <i class="fa fa-comments"></i>
                                        5 comments
                                    </a>
                                </li>
                                <li class="active">
                                    <i class="icon-fire"></i>
                                    3,005
                                </li>--}}
                                <li class="share-post">
                                    <a href="#">
                                        <i class="fa fa-share"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fa fa-home"></i>
                                Beranda
                            </a>
                        </li>
                        @foreach($post->kategori as $kt)
                            <li>
                                <a href="{{ url('post/kategori/'. $kt->label) }}">{{ $kt->label }}</a>
                            </li>
                        @endforeach
                    </ol>
                    <!-- breadcump end-->
                    <div class="ts-grid-box content-wrapper single-post">

                        <!-- single post header end-->
                        <div class="post-content-area">
                            <div class="entry-content">
                                {!! $post->content !!}
                            </div>
                            <!-- entry content end-->
                        </div>
                        <!-- post content area-->
                        <div class="author-box mt-5">
                            <img class="author-img" src="https://ui-avatars.com/api/?name=Administrator" alt="">
                            <div class="author-info">
                                <h4 class="author-name">Administrator</h4>
                                <div class="authors-social">
                                    <a href="{{ $settings['app_yt'] }}" class="ts-google-plus">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                    <a href="{{ $settings['app_fb'] }}" class="ts-facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="{{ $settings['app_ig'] }}" class="ts-google-plus">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                                <p>{{ $settings['app_desc'] }}</p>

                            </div>
                        </div>
                        <!-- author box end-->
                        <div class="post-navigation clearfix">
                            @if($prev_post)
                            <div class="post-previous float-left">
                                <a href="{{ url('post/'.$prev_post->seotitle) }}">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($prev_post->picture) }}" alt="">
                                    <span>Konten Sebelumnya</span>
                                    <p>
                                        {{ \Illuminate\Support\Str::words($prev_post->title, 10) }}
                                    </p>
                                </a>
                            </div>
                            @endif
                                @if($next_post)
                            <div class="post-next float-right">
                                <a href="{{ url('post/'.$next_post->seotitle) }}">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($next_post->picture) }}" alt="">
                                    <span>Konten Selanjutnya</span>
                                    <p>
                                        {{ \Illuminate\Support\Str::words($next_post->title, 10) }}
                                    </p>
                                </a>
                            </div>
                            @endif
                        </div>
                        <!-- post navigation end-->
                    </div>
                    <!--single post end -->
                    <!-- comment form end-->
                    <div class="ts-grid-box mb-30">
                        <h2 class="ts-title">Random Konten</h2>

                        <div class="most-populers owl-carousel">
                            @foreach($randKonten as $rk)
                            <div class="item">
                                <a class="post-cat ts-yellow-bg" href="#">{{ implode(',', $rk->kategori->pluck('label')->toArray()) }}</a>
                                <div class="ts-post-thumb">
                                    <a href="#">
                                        <img style="max-height: 155px" class="img-fluid" src="{{ \Illuminate\Support\Facades\Storage::url($rk->picture) }}" alt="">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h3 class="post-title">
                                        <a href="{{ url('post/'.$rk->seotitle) }}">{{ $rk->title }}</a>
                                    </h3>
                                    <span class="post-date-info">
										<i class="fa fa-clock-o"></i>
										{{ \Carbon\Carbon::parse($rk->tanggal)->isoFormat('MMMM, D YYYY') }}
									</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- most-populers end-->
                    </div>

                </div>
                <!-- col end -->
                <div class="col-lg-3">
                    <div class="right-sidebar">
                        <div class="ts-grid-box widgets ts-social-list-item">
                            <h2 class="ts-title">Sosial Media Kami</h2>
                            <ul>
                                <li class="ts-facebook">
                                    <a href="{{ $settings['app_fb'] }}">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                </li>
                                <li class="ts-youtube">
                                    <a href="{{ $settings['app_yt'] }}">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="ts-instragram">
                                    <a href="{{ $settings['app_ig'] }}">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- widgets end-->
                        <div class="post-list-item widgets">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a class="active" href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                        <i class="fa fa-clock-o"></i>
                                        Terbaru
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                        <i class="fa fa-refresh"></i>
                                        Random
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active ts-grid-box post-tab-list" id="home">
                                    @foreach($recentPost as $rp)
                                    <div class="post-content media">
                                        <img class="d-flex sidebar-img" src="{{ \Illuminate\Support\Facades\Storage::url($rp->picture) }}" alt="">
                                        <div class="media-body">
											<span class="post-tag">
												<a href="#" class="green-color"> {{ implode(',', $rp->kategori->pluck('label')->toArray()) }}</a>
											</span>
                                            <h4 class="post-title">
                                                <a href="{{ url('post/'.$rp->seotitle) }}">{{ \Illuminate\Support\Str::words($rp->title, 5) }} </a>
                                            </h4>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!--ts-grid-box end -->

                                <div role="tabpanel" class="tab-pane ts-grid-box post-tab-list" id="profile">
                                    @foreach($randKonten as $rp)
                                        <div class="post-content media">
                                            <img class="d-flex sidebar-img" src="{{ \Illuminate\Support\Facades\Storage::url($rp->picture) }}" alt="">
                                            <div class="media-body">
											<span class="post-tag">
												<a href="#" class="green-color"> {{ implode(',', $rp->kategori->pluck('label')->toArray()) }}</a>
											</span>
                                                <h4 class="post-title">
                                                    <a href="{{ url('post/'.$rp->seotitle) }}">{{ \Illuminate\Support\Str::words($rp->title, 5) }} </a>
                                                </h4>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--ts-grid-box end -->
                            </div>
                            <!-- tab content end-->
                        </div>

{{--                        @include('fronts.layout.kategori')--}}

                    </div>
                </div>
                <!-- right sidebar end-->
                <!-- col end-->
            </div>
            <!-- row end-->
        </div>
        <!-- container-->
    </section>
    @include('fronts.layout._footer')

@endsection

@push('lib-js')
@endpush
@push('js')
@endpush
