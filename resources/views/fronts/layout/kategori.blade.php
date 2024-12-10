<div class="widgets widgets-item">
    <h3 class="widget-title">
        <span>Kategori</span>
    </h3>
    <ul class="category-list">
        @foreach($cacheKategori as $kt)
        <li>
            <a href="{{ url('post/kategori/' . $kt->label) }}">{{ \Illuminate\Support\Str::ucfirst($kt->label) }}
                <span class="ts-orange-bg">{{ $kt->galeri_count }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
