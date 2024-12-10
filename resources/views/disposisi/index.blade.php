@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
@endsection

@section('content')
    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h3 class="card-title">Surat Disposisi</h3>
                    </div>
                    <div class="hr-text">Filter</div>
                    <div class="card-body border-bottom py-2">
                        <div class="row">
                            <div class="col-md-4 my-sm-0 my-1">
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3 col-form-label">Status</label>
                                    <div class="col">
                                        <select class="form-select" id="select-status">
                                            <option value="internal">Internal</option>
                                            <option value="eksternal">Eksternal</option>
                                        </select>
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
                                    <input id="search" type="text" class="form-control" placeholder="Cari Surat...">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-4 col-form-label">Per Page :</label>
                                    <div class="col">
                                        <select class="form-select" id="perPage">
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                            <option value="45">45</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        @include('layouts._loading')
        <div id="table-data">
        </div>
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
    <script>
        var page = 1;
        var search = '';
        var status = '';
        var paginate = 12;
        var tableCheck = [];
        var type = 'internal'

        $(document).ready(function () {
            type = $('#select-status').val()
            loadTable()

            $('#search').on('keypress', function (e) {
                if (e.which == 13) {
                    filterTable()
                    return false;
                }
            })

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
                $('.row-cards .card input[type="checkbox"]').prop('checked', true)
                let elem = $('.row-cards .card input[type="checkbox"]:checked');
                elem.each(function (index) {
                    let value = tableCheck.indexOf($(this).val());
                    if (value === -1) {
                        tableCheck.push($(this).val());
                    }
                })
            } else {
                $('.row-cards .card input[type="checkbox"]').prop('checked', false)
                let elem = $('.row-cards .card input[type="checkbox"]:not(:checked)');
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

        function filterTable() {
            search = $('#search').val();
            type = $('#select-status').val();
            paginate = $('#perPage').val();
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
                    type: type
                }
            }
            loading(true)
            await transAjax(param).then((result) => {
                loading(false)
                $('#table-data').html(result)
                initMagnific()
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
            $('#checkAll').prop('checked', false)
            page = to
            filterTable()
        }
    </script>
@endpush
