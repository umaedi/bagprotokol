<div class="ts-breaking-news clearfix">
    <h2 class="breaking-title float-left">
        <i class="fa fa-bolt"></i> Terbaru :</h2>
    <div class="breaking-news-content float-left" id="breaking_slider1">
        @foreach($cacheBreaking as $rp)
        <div class="breaking-post-content">
            <p>
                <a href="{{ url('post/'. $rp->seotitle) }}">{{ $rp->title }}</a>
            </p>
        </div>
        @endforeach
    </div>
</div>
