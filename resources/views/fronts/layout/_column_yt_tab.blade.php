@foreach($posts as $yt)
    <div class="col-md-6 mb-2">
        <a class="nav-item nav-link"
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
@endforeach
