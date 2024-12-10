<table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
    <tr>
        <th class="w-1"><input class="form-check-input m-0 align-middle" onchange="checkAll()" type="checkbox"
                               aria-label="Pilih semua data"></th>
        <th class="w-1">No Surat</th>
        <th>Tanggal</th>
        <th>Perihal</th>
        <th>Pengirim</th>
        <th>Karakteristik Surat</th>
        <th>Lampiran Surat</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse($table as $key => $tb)
        <tr>
            <td><input onchange="checkValue()" value="{{ $tb->eks_id }}"
                       class="form-check-input m-0 align-middle check-table" type="checkbox" aria-label="Pilih data"
                       id="check-id-{{ $tb->eks_id }}"></td>
            <td><span class="text-muted">{{ $tb->eks_nosurat }}<br> <span
                        class="badge bg-primary">{{ $tb->eks_pengirim }}</span></span></td>
            <td>
                <span>Tanggal Surat: <b>{{ \Carbon\Carbon::parse($tb->eks_tgl_surat)->isoFormat('D/MMMM/YYYY') }}</b></span>
                <br>
                <span>Tanggal Diterima: <b>{{ \Carbon\Carbon::parse($tb->eks_tgl_kirim)->isoFormat('D/MMMM/YYYY') }}</b></span>
            </td>
            <td><span>{{ $tb->eks_perihal }}</span></td>
            <td>
                <span>
                    @if($tb->eks_id_opd != null)
                        {{ $tb->pengirim->nama_opd }}
                    @else
                        {{ $tb->eks_dari }}
                    @endif
                </span><br>
                <span class="badge bg-success">Surat {{ $tb->eks_status }}</span>
            </td>

            <td>
                <span>{{ $tb->eks_karakteristik }}</span> <br>
                <span class="badge bg-warning">{{ $tb->eks_derajat }}</span>
            </td>

            <td>
                <a href="{{ \Illuminate\Support\Facades\Storage::url($tb->eks_file_lampiran) }}">{{ $tb->eks_nosurat }}</a>
            </td>

            <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                  @if($tb->eks_status == 'Disposisi')
                                  <a class="dropdown-item" href="{{ url('surat/eksternal/detail/'.\Vinkla\Hashids\Facades\Hashids::encode($tb->eks_id)) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                         width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                          <circle cx="10" cy="10" r="7"/>
                                          <line x1="21" y1="21" x2="15" y2="15"/>
                                        </svg> Lihat
                                </a>
                                  @endif
                                <a class="dropdown-item" href="{{ url('surat/eksternal/edit/'.$tb->eks_id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                       <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                                    </svg> Edit
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapus({{ $tb->eks_id }})">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                      width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <line x1="4" y1="7" x2="20" y2="7"></line>
                                   <line x1="10" y1="11" x2="10" y2="17"></line>
                                   <line x1="14" y1="11" x2="14" y2="17"></line>
                                   <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                   <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg> Hapus
                                </a>
                              </div>
                            </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">
                <div class="empty">
                    <div class="empty-img">
                        <svg style="width: 96px; height: 96px" xmlns="http://www.w3.org/2000/svg"
                             class="icon icon-tabler icon-tabler-database-off" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74"></path>
                            <path
                                d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6"></path>
                            <path d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4"></path>
                            <line x1="3" y1="3" x2="21" y2="21"></line>
                        </svg>
                    </div>
                    <p class="empty-title">Tidak ada data yang tersedia</p>
                    <p class="empty-subtitle text-muted">
                        Ayo coba buat satu data!
                    </p>
                    <div class="empty-action">
                        <a href="{{ url('surat/eksternal/create') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <!-- SVG icon code -->
                            Tambah Surat Eksternal
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="d-flex align-items-center m-2">
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
            <a role="button" onclick="gantiStatusBanyak('Masuk')" class="dropdown-item" href="javascript:void(0);">
                Masuk
            </a>
            <a role="button" onclick="gantiStatusBanyak('Tembusan')" class="dropdown-item" href="javascript:void(0);">
                Tembusan
            </a>
            <a role="button" onclick="gantiStatusBanyak('Disposisi')" class="dropdown-item" href="javascript:void(0);">
                Disposisi
            </a>
        </div>
    </div>
    <p class="m-0 text-muted">Showing <span>{{ $table->firstItem() }}</span> to <span>{{ $table->lastItem() }}</span> of
        <span>{{ $table->total() }}</span> data</p>
        {{$table->onEachSide(1)->links('vendor.pagination.tabler-paging', ['paginator' => $table])}}
</div>
