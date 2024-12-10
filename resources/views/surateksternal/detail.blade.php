@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('/') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
                Home
            </a>
            @if(!in_array(auth()->user()->level, [env('role_admin'), env('role_superadmin')]))
            @if($gainedAccessDis)
                @if($btnTerima !== false)
                    <button onclick="terima('{{ $disID}}')" class="btn btn-info d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 12l5 5l10 -10" />
                            <path d="M2 12l5 5m5 -5l5 -5" />
                        </svg>
                        Terima
                    </button>
                @endif

                @if(!$btnTerima)
                    <a href="{{ url('/surat/disposisi/'. \Vinkla\Hashids\Facades\Hashids::encode($surat->eks_id). '/eksternal/' . \Vinkla\Hashids\Facades\Hashids::encode($disID)) }}" class="btn btn-primary d-none d-sm-inline-block">
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
            @endif
            <a href="{{ url('/') }}"  class="btn btn-success d-sm-none btn-icon">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
            </a>
            @if(!in_array(auth()->user()->level, [env('role_admin'), env('role_superadmin')]))

            @if($gainedAccessDis)
                @if($btnTerima !== false)
                    <button onclick="terima('{{ $disID }}')"  class="btn btn-info d-sm-none btn-icon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 12l5 5l10 -10" />
                            <path d="M2 12l5 5m5 -5l5 -5" />
                        </svg>
                    </button>
                @endif

                @if(!$btnTerima)
                    <a href="{{ url('/surat/disposisi/'. \Vinkla\Hashids\Facades\Hashids::encode($surat->eks_id). '/eksternal/' . \Vinkla\Hashids\Facades\Hashids::encode($disID)) }}"  class="btn btn-primary d-sm-none btn-icon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-left-right" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="21" y1="17" x2="3" y2="17" />
                            <path d="M6 10l-3 -3l3 -3" />
                            <line x1="3" y1="7" x2="21" y2="7" />
                            <path d="M18 20l3 -3l-3 -3" />
                        </svg>
                    </a>
                @endif
            @endif
            @endif
        </div>
    </div>
@endsection

@section('content')

    <div class="container-xl">
        @include('surateksternal._detail')
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            initMagnific()
        })
        function terima(id) {
            Swal.fire({
                title: "Konfirmasi Terima?",
                text: "Surat yang telah diterima harus segera di tindak lanjut/disposisi!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, Terima!",
                cancelButtonText: "Tidak, Batalkan!",
                confirmButtonClass: "btn btn-success me-2",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: !1,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise(async function (resolve) {
                        var param = {
                            method: 'POST',
                            url: '{{ url('surat/disposisi/terima') }}/' + id,
                            data: {
                                '_method': 'PUT'
                            }
                        }
                        await transAjax(param).then((result) => {
                            Swal.fire({
                                title: "Berhasil!",
                                text: result.message,
                                icon: "success"
                            })
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        }).catch((err) => {
                            initToast('Mohon Maaf', err.message, 'danger', 'Silahkan coba lagi nanti')
                            Swal.close();
                        });
                    })
                }
            }).then(function (t) {
                if (!t.value) {
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Dibatalkan",
                        text: "Data batal dihapus!",
                        icon: "error"
                    })
                }
            })
        }
    </script>
@endpush
