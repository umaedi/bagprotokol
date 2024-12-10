@foreach($posts as $yt)
    <div
        class="tab-pane ts-overlay-style fade"
        id="nav-{{ $yt->id }}"
        role="tabpanel" aria-labelledby="nav-home-tab">
        <iframe src="https://www.youtube.com/embed/{{ $yt->url }}" frameborder="0" width="100%" height="500px"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        <!-- item end-->
    </div>
@endforeach
