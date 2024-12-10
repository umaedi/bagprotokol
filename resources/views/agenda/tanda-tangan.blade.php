@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('agenda') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
                Kembali
            </a>
            <a href="{{ url('agenda') }}"  class="btn btn-success d-sm-none btn-icon">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
            </a>
        </div>
    </div>
@endsection

@section('content')

    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                @if($feedback = session('feedback'))
                    @include('layouts._alert_feedback', ['feedback' => $feedback])
                @endif
                <form action="{{ url('agenda/tanda-tangan/' . $data->id) }}" method="post">
                    @csrf
                <div class="card">
                    <div class="card-status-start bg-green"></div>
                    <div class="card-header">
                        <h4 class="card-title">Form Isian Tanda Tangan Agenda</h4>
                    </div>
                    <div class="card-body">
                        <div class="hr-text hr-text-left">Kepala Bagian</div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nama Jabatan Kepala Bagian</label>
                            <div class="col">
                                <input type="text" name="nama_jabatan_bag" id="agenda_nama" value="{{ old('nama_jabatan_bag', $data->nama_jabatan_bag) }}" class="form-control @error('nama_jabatan_bag') is-invalid @enderror" placeholder="Masukkan Nama Jabatan Kepala Bagian..">
                                @error('nama_jabatan_bag')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Pangkat Kepala Bagian</label>
                            <div class="col">
                                <input type="text" name="pangkat_bag" id="pangkat_bag" value="{{ old('pangkat_bag', $data->pangkat_bag) }}" class="form-control @error('pangkat_bag') is-invalid @enderror" placeholder="Masukkan Pangkat Bagian..">
                                @error('pangkat_bag')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">NIP Kepala Bagian</label>
                            <div class="col">
                                <input type="text" name="nip_pejabat_bag" id="nip_pejabat_bag" value="{{ old('nip_pejabat_bag', $data->nip_pejabat_bag) }}" class="form-control @error('nip_pejabat_bag') is-invalid @enderror" placeholder="Masukkan NIP Pejabat Bagian..">
                                @error('nip_pejabat_bag')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nama Pejabat Kepala Bagian</label>
                            <div class="col">
                                <input type="text" name="nama_pejabat_bag" id="nama_pejabat_bag" value="{{ old('nama_pejabat_bag', $data->nama_pejabat_bag) }}" class="form-control @error('nama_pejabat_bag') is-invalid @enderror" placeholder="Masukkan Nama Pejabat Kepala Bagian..">
                                @error('nama_pejabat_bag')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-text hr-text-left">Kepala Sub Bagian</div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nama Jabatan Kepala Sub Bagian</label>
                            <div class="col">
                                <input type="text" name="nama_jabatan_sub" value="{{ old('nama_jabatan_sub', $data->nama_jabatan_sub) }}" class="form-control @error('nama_jabatan_bag') is-invalid @enderror" placeholder="Masukkan Nama Jabatan Kepala Sub Bagian..">
                                @error('nama_jabatan_sub')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Pangkat Kepala Sub Bagian</label>
                            <div class="col">
                                <input type="text" name="pangkat_sub" id="pangkat_sub" value="{{ old('pangkat_sub', $data->pangkat_sub) }}" class="form-control @error('pangkat_sub') is-invalid @enderror" placeholder="Masukkan Pangkat Sub Bagian..">
                                @error('pangkat_sub')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">NIP Kepala Sub Bagian</label>
                            <div class="col">
                                <input type="text" name="nip_pejabat_sub" id="nip_pejabat_sub" value="{{ old('nip_pejabat_sub', $data->nip_pejabat_sub) }}" class="form-control @error('nip_pejabat_sub') is-invalid @enderror" placeholder="Masukkan NIP Pejabat Sub Bagian..">
                                @error('nip_pejabat_sub')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nama Pejabat Kepala Sub Bagian</label>
                            <div class="col">
                                <input type="text" name="nama_pejabat_sub" id="nama_pejabat_sub" value="{{ old('nama_pejabat_sub', $data->nama_pejabat_sub) }}" class="form-control @error('nama_pejabat_sub') is-invalid @enderror" placeholder="Masukkan Nama Pejabat Kepala Sub Bagian..">
                                @error('nama_pejabat_sub')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <circle cx="12" cy="14" r="2"></circle>
                                <polyline points="14 4 14 8 8 8 8 4"></polyline>
                            </svg> Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('#agenda_waktu').timepicker({
                timeFormat: 'H:mm:ss'
            })

            $("#agenda_tgl_mulai").datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function(dateText, inst) {
                    var date = $.datepicker.parseDate('dd/mm/yy', dateText);
                    date.setDate(date.getDate());

                    var $tgl_akhir = $("#agenda_tgl_akhir");

                    $tgl_akhir.datepicker("option", "minDate", date);

                    $(this).datepicker("hide");

                }
            });

            $("#agenda_tgl_akhir").datepicker({
                dateFormat: 'dd/mm/yy',
            });
        })
    </script>
@endpush
