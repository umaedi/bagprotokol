@extends('fronts.layout.template')
@push('lib-css')
@endpush
@push('css')
    <style>
        .ts-title {
            font-size: 2rem;
            margin: 5px 0;
        }
    </style>
@endpush


@section('content')

    <div class="body-inner-content">
    @include('fronts.layout.header')
    <!-- block wrapper start-->
        <section class="block-wrapper mt-15 py-0">
            <div class="container">
                <div class="row post-style-3">
                    @foreach($recent_foto as $rf)
                        @if($loop->first)
                            <div class="col-lg-7 pr-0">
                                <div class="ts-overlay-style featured-post">
                                    <div class="item"
                                         style="background-image:url('{{ \Illuminate\Support\Facades\Storage::url($rf->picture) }}')">
                                        <a class="post-cat ts-orange-bg"
                                           href="#">{{ implode(',', $rf->kategori->pluck('label')->toArray()) }}</a>
                                        <div class="overlay-post-content">
                                            <div class="post-content">
                                                <h2 class="post-title large">
                                                    <a href="{{ url('post/'.$rf->seotitle) }}">{{ \Illuminate\Support\Str::ucfirst($rf->title) }}</a>
                                                </h2>
                                                <ul class="post-meta-info">
                                                    <li class="author">
                                                        <span>
                                                            <img src="https://ui-avatars.com/api/?name=Administrator"
                                                                 alt="">
                                                            Administrator
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-clock-o"></i>
                                                        {{ \Carbon\Carbon::parse($rf->tanggal)->isoFormat('dddd, D YYYY') }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ Featured post end -->
                                    </div>
                                </div>
                            </div>
                    @endif
                @endforeach
                <!-- col end-->
                    <div class="col-lg-5 pl-1 featured-post post-style-4">
                        @foreach($recent_foto as $rf)
                            @if(!$loop->first)
                                @if($loop->iteration == 2)
                                    <div class="ts-overlay-style">
                                        <div class="item height-310"
                                             style="background-image:url('{{ \Illuminate\Support\Facades\Storage::url($rf->picture) }}')">
                                            <a class="post-cat ts-orange-bg"
                                               href="#">{{ implode(',', $rf->kategori->pluck('label')->toArray()) }}</a>
                                            <div class="overlay-post-content">
                                                <div class="post-content">
                                                    <h2 class="post-title md">
                                                        <a href="{{ url('post/'.$rf->seotitle) }}">{{ \Illuminate\Support\Str::ucfirst($rf->title) }}</a>
                                                    </h2>
                                                    <span class="post-date-info">
											<i class="fa fa-clock-o"> </i>{{ \Carbon\Carbon::parse($rf->tanggal)->isoFormat('dddd, D YYYY') }}
										</span>
                                                </div>
                                            </div>
                                            <!--/ Featured post end -->
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        <div class="row">
                            @foreach($recent_foto as $rf)
                                @if($loop->iteration > 2)
                                    <div class="col-lg-6 @if($loop->iteration > 3) pl-0 @else pr-1 @endif">
                                        <div class="ts-overlay-style">
                                            <div class="item height-190"
                                                 style="background-image:url('{{ \Illuminate\Support\Facades\Storage::url($rf->picture) }}')">
                                                <a class="post-cat ts-green-bg"
                                                   href="#">{{ \Illuminate\Support\Str::limit(implode(',', $rf->kategori->pluck('label')->toArray()), 25) }}</a>
                                                <div class="overlay-post-content">
                                                    <div class="post-content">
                                                        <h2 class="post-title">
                                                            <a href="{{ url('post/'.$rf->seotitle) }}">{{ \Illuminate\Support\Str::ucfirst($rf->title) }}</a>
                                                        </h2>
                                                        <span class="post-date-info"><i class="fa fa-clock-o"> </i> {{ \Carbon\Carbon::parse($rf->tanggal)->isoFormat('dddd, D YYYY') }}</span>
                                                    </div>
                                                </div>
                                                <!--/ Featured post end -->
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- row end-->
            </div>
            <!-- container end-->
        </section>
        <!-- block wrapper end-->

        <section class="block-wrapper py-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="watch-post mb-10">
                            <div class="ts-heading-item">
                                <h2 class="ts-title">
                                    <span>Video Kami</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <div class="tab-content featured-post" id="nav-tabContent">
                                        @foreach($yts as $yt)
                                            @if($loop->iteration <= 6)
                                            <div
                                                class="tab-pane ts-overlay-style fade @if($loop->first) show active @endif"
                                                id="nav-{{ $yt->id }}"
                                                role="tabpanel" aria-labelledby="nav-home-tab">
                                                <iframe src="https://www.youtube.com/embed/{{ $yt->url }}" frameborder="0" width="100%" height="500px"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>
                                                <!-- item end-->
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                                <!-- col end-->

                                <div class="col-lg-12">
                                    <div class="row nav post-list-box" id="nav-tab" role="tablist">
                                        @foreach($yts as $yt)
                                            @if($loop->iteration <= 6)
                                            <div class="col-md-6 mb-2">
                                                <a class="nav-item nav-link @if($loop->first) active @endif"
                                                   id="nav-{{ $yt->id }}-tab" data-toggle="tab"
                                                   href="#nav-{{ $yt->id }}" role="tab" aria-controls="nav-home"
                                                   aria-selected="true">
                                                    <div class="post-content media">
                                                        <iframe src="https://www.youtube.com/embed/{{ $yt->url }}" frameborder="0" width="150px" style="height: 150px" class="rounded mr-1"
                                                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                                allowfullscreen></iframe>
                                                        <div class="media-body align-self-center">
                                                            <h4 class="post-title" style="font-size: 1.5rem!important;">
                                                              {{ $yt->title }}
                                                            </h4>
                                                            <span class="post-date-info">
														<i class="fa fa-clock-o"></i>
														{{ \Carbon\Carbon::parse($yt->created_at)->isoFormat('dddd, D YYYY') }}
													</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endif
                                    @endforeach
                                    <!-- nav item end-->
                                    </div>

                                    @if(count($yts) > 6)
                                        <div class="row mb-3">
                                            <div class="col-12 text-center">
                                                <button data-page="1" class="btn btn-sm btn-primary load-btn" type="button" onclick="loadMore('yt')">Load more</button>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- watch list post end-->
                                </div>
                                <!-- col end -->
                            </div>
                            <!-- row end-->
                        </div>


                        <!-- ts-populer-post-box end-->
                        @foreach($kategori as $ks)
                            <div class="ts-heading-item">
                                <h2 class="ts-title">
                                    <span>{{ $ks->label }}</span>
                                    <a class="float-right h6 mt-1 bg-white position-relative" href="{{ url('post/kategori/' . \Illuminate\Support\Str::lower($ks->label)) }}" style="z-index: 9999">Lebih banyak</a>
                                </h2>

                            </div>
                            <div class="row mb-10" id="{{ $ks->label }}-column">
                                @foreach($ks->galeri as $gp)
                                    @if($loop->iteration <= 6)
                                    <div class="col-lg-4 mb-3">
                                        <div class="ts-overlay-style">
                                            <div class="item"
                                                 style="height:265px; background-size: cover; background-image:url('{{ \Illuminate\Support\Facades\Storage::url($gp->picture) }}')">
                                                <div class="ts-post-thumb">
                                                    <a class="post-cat ts-blue-bg"
                                                       href="#">{{ implode(',', $gp->kategori->pluck('label')->toArray()) }}</a>
                                                    <a href="{{ url('post/'.$gp->seotitle) }}">
                                                    </a>

                                                </div>
                                                <div class="overlay-post-content">
                                                    <div class="post-content">
                                                        <h3 class="post-title md">
                                                            <a href="{{ url('post/'.$gp->seotitle) }}">{{ \Illuminate\Support\Str::ucfirst($gp->title) }}</a>
                                                        </h3>
                                                        <span class="post-date-info">
													<i class="fa fa-clock-o"></i>
													{{ \Carbon\Carbon::parse($gp->tanggal)->isoFormat('dddd, D YYYY') }}
												</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end item-->
                                        </div>
                                        <!-- ts overlay end-->
                                    </div>
                                    @endif
                            @endforeach
                            <!-- col end-->
                            </div>
                        @if(count($ks->galeri) > 6)
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <button data-page="1" class="btn btn-sm btn-primary load-btn" type="button" onclick="loadMore('{{ $ks->label }}')">Load more</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <!-- row end-->
                    </div>
                    <!-- col end-->
                </div>
            </div>
        </section>

        @include('fronts.layout._footer')

    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('.load-btn').on('click', function() {
                var $this = $(this);
                var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Loading...';
                if ($(this).html() !== loadingText) {
                    $this.data('original-text', $(this).html());
                    $this.html(loadingText);
                }
                setTimeout(function() {
                    $this.html($this.data('original-text'));
                }, 500);
            });
        })

        function loadMore(param) {
            var ini = $(event.target);
            var page = ini.data('page');
            $.ajax({
                'url': '{{ url()->current() }}',
                'type': 'GET',
                'data': {
                    'cat': param,
                    'page': page
                },
                success(res) {
                    if(param === 'yt') {
                        $('#nav-tab').append(res.view_tab);
                        $('#nav-tabContent').append(res.view_content);
                    } else {
                        $('#' + param + '-column').append(res.view)
                    }
                    ini.data('page', res.page)
                },
                error(res) {
                    console.log(res)
                }
            })
        }
    </script>
@endpush
