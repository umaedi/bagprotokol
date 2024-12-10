<div class="row">
    <div class="col-md-12 mb-1">
        <div class="card">
            <div class="card-status-start bg-green"></div>
            <div class="card-header">
                <h4 class="card-title">Informasi Surat Nomor {{ $surat->no_surat }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">


                        <div class="row mb-2">
                            <div class="col-md-3">
                                Tanggal Surat
                            </div>
                            <div class="col font-weight-bold">{{ \Carbon\Carbon::parse($surat->tgl_surat)->isoFormat('dddd, D/MMMM/YYYY') }}</div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-3">
                                Tanggal Dikirim
                            </div>
                            <div class="col font-weight-bold">{{ \Carbon\Carbon::parse($surat->tgl_dikirim)->isoFormat('dddd, D/MMMM/YYYY') }}</div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-3">
                                Kepada
                            </div>
                            <div class="col font-weight-bold">{{ $surat->kepada }}</div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-3">
                                Perihal
                            </div>
                            <div class="col font-weight-bold">{{ $surat->perihal }}</div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-3">
                                Lampiran
                            </div>
                            <div class="col font-weight-bold">{{ $surat->lampiran ?? 'Tidak ada' }} Lampiran</div>
                        </div>

                        <div class="row my-2">
                            <div class="col-md-3">
                                Ditanda Tangani oleh
                            </div>
                            <div class="col font-weight-bold">{{ $surat->ttd->jenis_ttd }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="hr-text hr-text-left mb-1 mt-1">Berkas</div>
                        <svg style="width: 100px; height: 100px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <line x1="9" y1="9" x2="10" y2="9" />
                            <line x1="9" y1="13" x2="15" y2="13" />
                            <line x1="9" y1="17" x2="15" y2="17" />
                        </svg>
                        <br>
                        <a target="_blank" href="{{ \Illuminate\Support\Facades\Storage::url($surat->berkas) }}">Berkas Surat: {{ $surat->no_surat }}</a>
                        <div class="hr-text hr-text-left mt-3 mb-2">QR Code</div>
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($surat->qrcode) }}" class="image-link">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($surat->qrcode) }}" class="avatar avatar-2xl">
                        </a>
                    </div>
                </div>



                <div class="hr-text hr-text-left">Informasi Tracking Surat</div>

{{--                <div class="row overflow-scroll">--}}
                <div class="row">
                    @forelse($surat->opds as $o)
{{--                        <div class="@if($loop->index != 0) mt-4 @endif" style="width: 1366px!important; max-width: none!important;">--}}
                        <div class="@if($loop->index != 0) mt-4 @endif">
                            <div class="card bg-info">
                                <div class="ribbon bg-danger">
                                    Tracking {{ $loop->index + 1 }}
                                </div>
                                <div class="card-body pt-5">
                                    {{-- DIKOMENTARI KARENA TIDAK MEMAKAI TBL PENERIMA QRCODE
                                    <ul class="list list-timeline">
                                        @php
                                            $filtered = $surat->disposisi->filter(function ($value, $key) use ($o) {
                                                return $value->dis_asal == $o->id_opd;
                                            });
                                        @endphp
                                        @forelse($filtered->all() as $p)

                                            <li>
                                                <div class="list-timeline-icon @if($p->dis_tgl_terima != null) bg-success @else bg-warning @endif"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                                    @if($p->dis_tgl_terima != null)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <circle cx="12" cy="12" r="9" />
                                                            <polyline points="12 7 12 12 15 15" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="list-timeline-content">
                                                    <div class="list-timeline-time">{{ \Carbon\Carbon::parse($p->dis_tgl)->isoFormat('D/MMM/YYYY') }}</div>
                                                    <p class="list-timeline-title">Surat <span class="badge bg-success">{{ $p->dis_status }}</span> ke {{ $p->tujuan->nama_opd }}</p>
                                                    <p class="text-muted">{{ $p->dis_catatan }}</p>
                                                    @if($p->dis_tgl_terima != null)
                                                        <p class="text-muted">Diterima pada : {{ \Carbon\Carbon::parse($p->dis_tgl)->isoFormat('dddd, D/MMM/YYYY') }}</p>
                                                    @endif
                                                </div>
                                            </li>
                                        @empty
                                        @endforelse

                                        <li>
                                            <div class="list-timeline-icon @if(count($surat->disposisi) == 0) bg-warning @else bg-success @endif"><!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                                @if(count($surat->disposisi) == 0)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <circle cx="12" cy="12" r="9" />
                                                        <polyline points="12 7 12 12 15 15" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                                @endif
                                            </div>
                                            <div class="list-timeline-content">
                                                @if(count($surat->disposisi) != 0)
                                                    <div class="list-timeline-time">{{ \Carbon\Carbon::parse($surat->tgl_diterima)->isoFormat('D/MMM/YYYY') }}</div>
                                                    <p class="list-timeline-title">Surat berhasil dikirim!</p>
                                                @else
                                                    <div class="list-timeline-time">{{ \Carbon\Carbon::parse($surat->tgl_dikirim)->isoFormat('D/MMM/YYYY') }}</div>
                                                    <p class="list-timeline-title">Surat sedang dikirim...</p>
                                                @endif
                                            </div>
                                        </li>--}}
                                        @if(count($o->children) != 0)
                                        @include('suratkeluar._timeline', ['children' => $o->children])

                                        <div class="text-center">
                                            <svg style="width: 40px; height: 40px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <line x1="12" y1="5" x2="12" y2="19" />
                                                <line x1="18" y1="11" x2="12" y2="5" />
                                                <line x1="6" y1="11" x2="12" y2="5" />
                                            </svg>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col">
                                                <div class="card pb-4">
                                                    <div class="ribbon ribbon-bottom @if($o->dis_tgl_terima != null) bg-success @else bg-warning @endif">
                                                        @if($o->dis_tgl_terima != null)
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                                            {{ \Carbon\Carbon::parse($o->tgl_dikirim)->isoFormat('D/MMM/YYYY') }}
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <circle cx="12" cy="12" r="9" />
                                                                <polyline points="12 7 12 12 15 15" />
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="list-timeline-title">Surat <span class="badge bg-success">{{ $o->dis_status }}</span> ke {{ $o->opd->nama_opd }}</p>
                                                        <p class="text-muted">{{ $o->dis_catatan }}</p>
                                                        @if($o->dis_tgl_terima != null)
                                                            <p class="text-muted">Diterima pada : {{ \Carbon\Carbon::parse($o->dis_tgl)->isoFormat('dddd, D/MMM/YYYY') }}</p>
                                                            @else
                                                            @if(in_array(auth()->user()->level, [env('role_superadmin'), env('role_admin'), env('role_surat')]))
                                                                <a href="{{ url('/surat/disposisi/'. \Vinkla\Hashids\Facades\Hashids::encode($surat->id_qr). '/surat/' . \Vinkla\Hashids\Facades\Hashids::encode($o->dis_id)) }}" class="btn btn-primary">
                                                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-left-right" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                        <line x1="21" y1="17" x2="3" y2="17" />
                                                                        <path d="M6 10l-3 -3l3 -3" />
                                                                        <line x1="3" y1="7" x2="21" y2="7" />
                                                                        <path d="M18 20l3 -3l-3 -3" />
                                                                    </svg>
                                                                    Disposisi
                                                                </a>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                    </ul>--}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada tujuan surat.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    {{--<div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Berkas-berkas</h4>
            </div>
            <div class="card-body text-center">

            </div>
        </div>
    </div>--}}
</div>
