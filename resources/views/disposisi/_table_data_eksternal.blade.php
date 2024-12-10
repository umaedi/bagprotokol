<div class="row row-deck mt-1" data-masonry='{"percentPosition": true }'>
    @forelse($table as $tb)
        <div class="col-sm-6 col-lg-4 my-1">
            <div class="card">
                <div class="row row-0">
                    <div class="col-4 position-relative">
                        @if(\Illuminate\Support\Facades\Storage::exists($tb->eks_qrcode) && $tb->eks_qrcode != null)
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($tb->eks_qrcode) }}" class="image-link">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($tb->eks_qrcode) }}" class="w-100 h-100 object-cover">
                        </a>
                        @else
                            <a href="https://ui-avatars.com/api/?name={{ $tb->no_surat }}" class="image-link">
                                <img src="https://ui-avatars.com/api/?name={{ $tb->no_surat }}" class="w-100 h-100 object-cover">
                            </a>
                        @endif
                    </div>
                    <div class="col">
                        <div class="card-body">

                            <h4 class="card-title">No. {{ $tb->eks_nosurat }}</h4>
                            <span>{{ \Carbon\Carbon::parse($tb->eks_tgl_surat)->isoFormat('dddd, D/MMMM/YYYY') }}</span><br>
{{--                            <span><b>{{ $tb->opd->nama_opd }}</b></span>--}}
                            <span>{{ \Illuminate\Support\Str::words(\Illuminate\Support\Str::ucfirst($tb->eks_perihal), 5, '...') }}</span>
                        </div>
                        <div class="card-footer">
                            <div class="btn-list justify-content-center">
                                <a href="{{ url('surat/eksternal/detail/'.\Vinkla\Hashids\Facades\Hashids::encode($tb->eks_id)) }}" target="_blank" class="btn btn-primary btn-icon" aria-label="Button">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="10" cy="10" r="7" />
                                        <line x1="21" y1="21" x2="15" y2="15" />
                                    </svg>
                                </a>
                                @if($user['level'] != 'user')
                                <a href="{{ url('surat/eksternal/edit/' . $tb->eks_id) }}" class="btn btn-warning btn-icon" aria-label="Button">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                        <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                    </svg>
                                </a>
                                @endif
                                <a target="_blank" href="{{ \Illuminate\Support\Facades\Storage::url($tb->eks_file_lampiran) }}" class="btn btn-success btn-icon" aria-label="Button">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                        <rect x="7" y="13" width="10" height="8" rx="2" />
                                    </svg>
                                </a>
                                @if($user['level'] != 'user')
                                <a href="javascript:void(0)" class="btn btn-danger btn-icon" aria-label="Button" onclick="hapus({{ $tb->eks_id }})">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </a>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="empty">
            <div class="empty-img">
                <svg  style="width: 96px; height: 96px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74"></path>
                    <path d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6"></path>
                    <path d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4"></path>
                    <line x1="3" y1="3" x2="21" y2="21"></line>
                </svg>
            </div>
            <p class="empty-title">Tidak ada data yang dicari!</p>
            <p class="empty-subtitle text-muted">
                Tunggu notifikasi dari <sistem class=""></sistem>
            </p>
        </div>
    @endforelse
</div>
<div class="d-flex align-items-center my-2">

    @if($user != 'user')
    <div class="dropdown">
        <button type="button" class="btn dropdown-toggle me-2" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-left" width="44"
                 height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round"
                 stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="4" y1="6" x2="20" y2="6"/>
                <line x1="4" y1="12" x2="14" y2="12"/>
                <line x1="4" y1="18" x2="18" y2="18"/>
            </svg>
            Aksi Banyak
        </button>
        <div class="dropdown-menu">
            <a role="button" onclick="hapusBanyak()" class="dropdown-item" href="javascript:void(0);">
                Hapus
            </a>
            {{--<a role="button" onclick="gantiStatusBanyak('Masuk')" class="dropdown-item" href="javascript:void(0);">
                Masuk
            </a>
            <a role="button" onclick="gantiStatusBanyak('Tembusan')" class="dropdown-item" href="javascript:void(0);">
                Tembusan
            </a>
            <a role="button" onclick="gantiStatusBanyak('Disposisi')" class="dropdown-item" href="javascript:void(0);">
                Disposisi
            </a>--}}
        </div>
    </div>
    @endif
    <p class="m-0 text-muted">Showing <span>{{ $table->firstItem() }}</span> to <span>{{ $table->lastItem() }}</span> of
        <span>{{ $table->total() }}</span> data</p>
        {{$table->onEachSide(1)->links('vendor.pagination.tabler-paging', ['paginator' => $table])}}
</div>
