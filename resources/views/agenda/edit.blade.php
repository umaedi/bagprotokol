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
                <form action="{{ url('agenda/'.$edit->agenda_id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="card">
                    <div class="card-status-start bg-warning"></div>
                    <div class="card-header">
                        <h4 class="card-title">Form Edit Agenda</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nama Agenda</label>
                            <div class="col">
                                <input type="text" name="agenda_nama" id="agenda_nama" value="{{ old('agenda_nama', $edit->agenda_nama) }}" class="form-control @error('agenda_nama') is-invalid @enderror" placeholder="Masukkan Nama Agenda..">
                                @error('agenda_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Lokasi Agenda</label>
                            <div class="col">
                                <input type="text" name="agenda_lokasi" id="agenda_lokasi" value="{{ old('agenda_lokasi', $edit->agenda_lokasi) }}" class="form-control @error('agenda_lokasi') is-invalid @enderror" placeholder="Masukkan Lokasi Agenda..">
                                @error('agenda_lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Pakaian Agenda</label>
                            <div class="col">
                                <input type="text" name="agenda_pakaian" id="agenda_pakaian" value="{{ old('agenda_pakaian',$edit->agenda_pakaian) }}" class="form-control @error('agenda_pakaian') is-invalid @enderror" placeholder="Masukkan Pakaian yang dipakai untuk Agenda..">
                                @error('agenda_pakaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Pejabat</label>
                            <div class="col">
                                <input type="text" name="agenda_pejabat" id="agenda_pejabat" value="{{ old('agenda_pejabat', $edit->agenda_pejabat) }}" class="form-control @error('agenda_pejabat') is-invalid @enderror" placeholder="Masukkan Pejabat ke Agenda..">
                                @error('agenda_pejabat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{--<div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Undangan</label>
                            <div class="col">
                                <input data-role="tagsinput" type="text" name="agenda_undangan" id="agenda_undangan" value="{{ old('agenda_undangan', $edit->agenda_undangan) }}" class="form-control d-none @error('agenda_undangan') is-invalid @enderror" placeholder="Masukkan Undangan ke Agenda..">
                                @error('agenda_undangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Tanggal Agenda</label>
                            <div class="col">
                                <input type="text" name="agenda_tgl_mulai" id="agenda_tgl_mulai" value="{{ old('agenda_tgl_mulai', \Carbon\Carbon::parse($edit->agenda_tgl_mulai)->format('d/m/Y')) }}" class="form-control @error('agenda_tgl_mulai') is-invalid @enderror" placeholder="Masukkan Tanggal Undangan ke Agenda..">
                                @error('agenda_tgl_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{--<div class="col">
                                <input type="text" name="agenda_tgl_akhir" id="agenda_tgl_akhir" value="{{ old('agenda_tgl_akhir', \Carbon\Carbon::parse($edit->agenda_tgl_akhir)->format('d/m/Y')) }}" class="form-control @error('agenda_tgl_akhir') is-invalid @enderror" placeholder="Masukkan Tanggal Undangan ke Agenda..">
                                @error('agenda_tgl_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>--}}
                        </div>


                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Waktu Agenda</label>
                            <div class="col">
                                <input readonly type="text" name="agenda_waktu" id="agenda_waktu" value="{{ old('agenda_waktu',$edit->agenda_waktu) }}" class="form-control @error('agenda_waktu') is-invalid @enderror" placeholder="Masukkan Waktu Agenda..">
                                @error('agenda_waktu')
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
