@foreach($post as $gp)
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
@endforeach
