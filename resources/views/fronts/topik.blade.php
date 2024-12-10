@extends('fronts.layout.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('content')
    @include('fronts.layout.header')
    <!-- block post area start-->
    <div class="body-inner-content category-layout-5">
    <section class="block-wrapper mt-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ts-grid-box entry-header">
                        <ol class="ts-breadcrumb">
                            <li>
                                <a href="{{ url('/') }}">
                                    <i class="fa fa-home"></i>
                                    Beranda
                                </a>
                            </li>
                            <li>
                                <a href="#">{{ \Illuminate\Support\Str::ucfirst($topik) }}</a>
                            </li>

                        </ol>
                        <div class="clearfix entry-cat-header">
                            <h2 class="ts-title float-left">{{ \Illuminate\Support\Str::ucfirst($topik) }}</h2>
                            <ul class="ts-category-list float-right">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse($posts as $ps)
                            <div class="col-lg-6 mb-10">
                            <div class="ts-overlay-style">
                                <div class="item" style="max-height: 250px">
                                    <div class="ts-post-thumb">
                                        <a class="post-cat ts-pink-bg" href="#">{{ implode(',', $ps->kategori->pluck('label')->toArray()) }}</a>
                                        <a href="#">
                                            <img class="img-fluid" src="{{ \Illuminate\Support\Facades\Storage::url($ps->picture) }}" alt="" style="width: 100%; height: 250px">
                                        </a>
                                    </div>

                                    <div class="overlay-post-content">
                                        <div class="post-content">
                                            <h3 class="post-title md">
                                                <a href="{{ url('/post/'. $ps->seotitle) }}">{{ $ps->title }}</a>
                                            </h3>
                                            <ul class="post-meta-info">
                                                <li>
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ \Carbon\Carbon::parse($ps->tanggal)->isoFormat('MMMM, d YYYY') }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- end item-->
                            </div>
                        </div>
                        @empty
                            <h3>Tidak ada postingan</h3>
                        @endforelse
                    </div>
                    <div class="ts-pagination text-center mb-20">
                        {{ $posts->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>

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
            </div>
            <!-- row end-->
        </div>
        <!-- container end-->
    </section>
        @include('fronts.layout._footer')
    </div>
    <!-- block area end-->
@endsection

@push('lib-js')
@endpush
@push('js')
@endpush
