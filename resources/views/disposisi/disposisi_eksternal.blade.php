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
            <div class="col-md-12 mb-1">
                @if($feedback = session('feedback'))
                    @include('layouts._alert_feedback', ['feedback' => $feedback])
                @endif
                <div class="card">
                    <form action="{{ url('surat/disposisi/eksternal/'. $disID) }}" method="post">
                        @csrf
                    <div class="card-status-start bg-warning"></div>
                    <div class="card-header"><h4 class="card-title">Form Disposisi</h4></div>
                    <div class="card-body">
                        {{--                            DIKOMENTARI DIKARENAKAN TIDAK MEMAKAI TABLE PERNERIMA QRCODE --}}
                        {{--<div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Tanggal Diterima</label>
                            <div class="col">
                                <input type="date" name="dis_tgl_terima" id="dis_tgl_terima" value="{{ old('dis_tgl_terima') }}" class="form-control @error('dis_tgl_terima') is-invalid @enderror" placeholder="Masukkan Tanggal Diterima Disposisi..">
                                @error('dis_tgl_terima')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Status Tindakan</label>
                            <div class="col">
                                <select name="dis_status" id="dis_status" class="form-control">
                                    <option value="Diteruskan">Diteruskan</option>
                                    <option value="Dihimpun">Dihimpun</option>
                                    <option value="Tindak Lanjut">Tindak Lanjut</option>
                                </select>
                                @error('dis_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3" id="opd-select">
                            <label class="form-label col-md-3 col-form-label">Tujuan Disposisi</label>
                            <div class="col">
                                <select name="dis_tujuan[]" id="dis_tujuan" class="form-control select2 @error('dis_tujuan') is-invalid @enderror" @if($user->level == 'superadmin' || $user->level == 'admin' || $user->level == 'surat' || $user->opd()->first()->level_pj != env('OPD_BIASA')) multiple @endif>
                                    <option></option>
                                    @foreach($opd as $o)
                                        <option {{ (collect(old('dis_tujuan'))->contains($o->id_opd)) ? 'selected':'' }} value="{{ $o->id_opd }}">{{ $o->nama_opd }}</option>
                                    @endforeach
                                </select>
                                <div class="form-hint">Biarkan <b>kosong</b> apabila surat hanya ingin disimpan.</div>
                                @error('tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Catatan</label>
                            <div class="col">
                                <textarea name="dis_catatan" id="dis_catatan" class="form-control @error('dis_catatan') is-invalid @enderror" placeholder="Masukkan Isi catatan.." rows="10">{{ old('dis_catatan') }}</textarea>
                                @error('dis_catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                <circle cx="12" cy="14" r="2" />
                                <polyline points="14 4 14 8 8 8 8 4" />
                            </svg>Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @include('surateksternal._detail')
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            initMagnific()
            if($('select[name="dis_status"]:selected').val() != 'Tindak Lanjut')
            {
                $('#opd-select').show()
            } else {
                $('#opd-select').hide();
            }


            $('select[name="dis_status"]').change(function () {
                var value = $(this).val();
                if(value != 'Tindak Lanjut') {
                    $('#opd-select').show();
                } else {
                    $('#opd-select').hide();
                }
            })

        })
    </script>
@endpush
