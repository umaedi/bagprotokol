@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('agenda/tanda-tangan') }}" class="btn btn-info d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Ubah Tanda Tangan Agenda
            </a>
            <a href="{{ url('agenda/create') }}" class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Tambah Agenda
            </a>
            <a href="{{ url('agenda/print') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                    <rect x="7" y="13" width="10" height="8" rx="2" />
                </svg>
                Print
            </a>
            <a href="{{ url('agenda/tanda-tangan') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Tambah Pengguna">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-certificate" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="15" cy="15" r="3" />
                    <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
                    <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
                    <line x1="6" y1="9" x2="18" y2="9" />
                    <line x1="6" y1="12" x2="9" y2="12" />
                    <line x1="6" y1="15" x2="8" y2="15" />
                </svg>
            </a>
            <a href="{{ url('agenda/create') }}" class="btn btn-primary d-sm-none btn-icon" aria-label="Tambah Pengguna">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            </a>
            <a href="{{ url('agenda/print') }}" class="btn btn-success d-sm-none btn-icon" aria-label="Tambah Pengguna">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                    <rect x="7" y="13" width="10" height="8" rx="2" />
                </svg>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title">Agenda</h3>
                    </div>
                    <div class="hr-text">Filter</div>
                    <div class="card-body border-bottom py-2">
                        <div class="row">
                            <div class="col-md-4 my-sm-0 my-1">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 my-sm-0 my-1">
                                <div class="btn-list">
                                    <button type="button" id="btn-filter" class="col-sm-auto col-12 btn btn-success">Filter</button>
                                </div>
                            </div>
                            <div class="col-md-3 my-sm-0 my-1">
                                <div class="form-group">
                                    <input id="search" type="text" class="form-control" placeholder="Cari Agenda...">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4 col-form-label">Per Page :</label>
                                    <div class="col">
                                        <select class="form-select" id="perPage">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @include('layouts._loading')
                    <div class="table-responsive mb-0" id="table-data">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
    <script>
        var page = 1;
        var search = '';
        var tanggal = '';
        var paginate = 10;
        var tableCheck = [];

        $(document).ready(function () {
            loadTable()

            $('#search').on('keypress', function (e) {
                if (e.which == 13) {
                    filterTable()
                    return false;
                }
            })

            $('#tanggal').keyup(function(e) {
                if(e.keyCode == 8 || e.keyCode == 46) {
                    $('#tanggal').val('')
                }
            });

            $("#perPage").change(function () {
                filterTable()
            })

            $('#btn-filter').click(function () {
                filterTable()
            })
        })

        function checkAll() {
            let check = $(event.target).is(':checked');
            if(check) {
                $('table tbody input[type="checkbox"]').prop('checked', true)
                let elem = $('table tbody input[type="checkbox"]:checked');
                elem.each(function (index) {
                    let value = tableCheck.indexOf($(this).val());
                    if (value === -1) {
                        tableCheck.push($(this).val());
                    }
                })
            } else {
                $('table tbody input[type="checkbox"]').prop('checked', false)
                let elem = $('table tbody input[type="checkbox"]:not(:checked)');
                elem.each(function (index) {
                    let value = tableCheck.indexOf($(this).val());
                    if (value !== -1) {
                        tableCheck.splice(value, 1);
                    }
                })
            }
        }

        function checkValue() {
            let id = $(event.target).val();
            let check = $(event.target).is(':checked');
            if (check) {
                tableCheck.push(id)
            } else {
                let index = tableCheck.indexOf($(event.target).val());
                if (index !== -1) {
                    tableCheck.splice(index, 1);
                }
            }
        }

        function hapus(id) {
            Swal.fire({
                title: "Konfirmasi Hapus!",
                text: "Apakah anda yakin untuk menghapus data ini?",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, Hapus!",
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
                            url: '{{ url()->current() }}/' + id,
                            data: {
                                '_method': 'DELETE'
                            }
                        }
                        loading(true)
                        await transAjax(param).then((result) => {
                            loadTable()
                            Swal.fire({
                                title: "Berhasil!",
                                text: result.message,
                                icon: "success"
                            })
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

        function hapusBanyak() {
            Swal.fire({
                title: "Konfirmasi Hapus Banyak!",
                text: "Apakah anda yakin untuk menghapus data-data ini?",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Iya, Hapus!",
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
                            url: '{{ url('agenda/bulk-delete') }}',
                            data: {
                                '_method': 'POST',
                                'ids': tableCheck
                            }
                        }
                        loading(true)
                        await transAjax(param).then((result) => {
                            tableCheck = []
                            loadTable()
                            Swal.fire({
                                title: "Berhasil!",
                                text: result.message,
                                icon: "success"
                            })
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

        function filterTable() {
            search = $('#search').val();
            status = $('#select-status').val();
            paginate = $('#perPage').val();
            tanggal = $('#tanggal').val();
            loadTable()
        }

        async function loadTable() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    page: page,
                    paginate: paginate,
                    search: search,
                    tanggal: tanggal,
                }
            }
            loading(true)
            await transAjax(param).then((result) => {
                loading(false)
                $('#table-data').html(result)
                checkRow()
            }).catch((err) => {
                loading(false)
                initToast('Mohon Maaf', 'Terjadi kesalahan pada sisi server/client.', 'warning', 'Silahkan coba lagi nanti')
            });
        }

        function checkRow() {
            tableCheck.forEach(function (item, index) {
                $('#check-id-' + item).prop('checked', true)
            })
        }

        function loading(state) {
            if(state) {
                $('#loading').removeClass('d-none');
            } else {
                $('#loading').addClass('d-none');
            }
        }


        function loadPaginate(to) {
            page = to
            filterTable()
        }
    </script>
@endpush
