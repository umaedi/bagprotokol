<div class="row align-items-end" data-masonry="{&quot;percentPosition&quot;: true }">
@foreach($children as $child)
            <div class="col">
                @if(count($child->children) != 0)
                    @include('suratkeluar._timeline', ['children' => $child->children])

                    <div class="text-center">
                        <svg style="width: 40px; height: 40px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="18" y1="11" x2="12" y2="5" />
                            <line x1="6" y1="11" x2="12" y2="5" />
                        </svg>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body pb-5">
                        <div class="ribbon ribbon-bottom @if($child->dis_tgl_terima != null) bg-success @else bg-warning @endif">
                            @if($child->dis_tgl_terima != null)
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                {{ \Carbon\Carbon::parse($child->tgl_dikirim)->isoFormat('D/MMM/YYYY') }}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <circle cx="12" cy="12" r="9" />
                                    <polyline points="12 7 12 12 15 15" />
                                </svg>
                            @endif
                        </div>
                            {{--@if(count($child->children) != 0)
                                @include('suratkeluar._timeline', ['children' => $child->children])
                            @endif
                            <li>--}}
                        <p class="list-timeline-title">Surat telah di- <span class="badge bg-success">{{ $child->dis_status }}</span> @if($child->dis_status != 'Tindak Lanjut') ke @else oleh @endif {{ $child->opd->nama_opd }}</p>
                        <p class="text-muted">{{ $child->dis_catatan }}</p>
                        @if($child->dis_tgl_terima != null && $child->dis_status != 'Tindak Lanjut')
                            <p class="text-muted">Diterima pada : {{ \Carbon\Carbon::parse($child->dis_tgl)->isoFormat('dddd, D/MMM/YYYY') }}</p>
                            @else
                            @if(in_array(auth()->user()->level, [env('role_superadmin'), env('role_admin'), env('role_surat')]))
                                @php
                                if(isset($surat->id_qr)) {
                                    $url = url('/surat/disposisi/'. \Vinkla\Hashids\Facades\Hashids::encode($surat->id_qr). '/surat/' . \Vinkla\Hashids\Facades\Hashids::encode($child->dis_id));
                                } else {
                                    $url = url('/surat/disposisi/'. \Vinkla\Hashids\Facades\Hashids::encode($surat->eks_id). '/eksternal/' . \Vinkla\Hashids\Facades\Hashids::encode($child->dis_id));
                                }
                                @endphp
                            <a href="{{ $url }}" class="btn btn-primary">
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
@endforeach
</div>
