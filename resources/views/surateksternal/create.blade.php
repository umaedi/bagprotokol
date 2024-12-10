@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('surat/eksternal') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
                Kembali
            </a>
            <a href="{{ url('surat/eksternal') }}"  class="btn btn-success d-sm-none btn-icon">
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
                <form action="{{ url('surat/eksternal') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="card-status-start bg-green"></div>
                    <div class="card-header">
                        <h4 class="card-title">Form Isian Surat Eksternal</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nomor Surat</label>
                            <div class="col">
                                <input type="text" name="eks_nosurat" id="eks_nosurat" value="{{ old('eks_nosurat') }}" class="form-control @error('eks_nosurat') is-invalid @enderror" placeholder="Masukkan Nomor Surat..">
                                @error('eks_nosurat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Tanggal Surat</label>
                            <div class="col">
                                <input type="date" name="eks_tgl_surat" id="eks_tgl_surat" value="{{ old('eks_tgl_surat') }}" class="form-control @error('eks_tgl_surat') is-invalid @enderror" placeholder="Masukkan Tanggal Surat..">
                                @error('eks_tgl_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Tanggal Diterima</label>
                            <div class="col">
                                <input type="date" name="eks_tgl_kirim" id="eks_tgl_kirim" value="{{ old('eks_tgl_kirim') }}" class="form-control @error('eks_tgl_kirim') is-invalid @enderror" placeholder="Masukkan Tanggal Diterima..">
                                @error('eks_tgl_kirim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Surat Dari</label>
                            <div class="col">
                                <select name="eks_id_opd" id="eks-id-opd" class="form-control select2 @error('eks_id_opd') is-invalid @enderror">
                                    <option></option>
                                    @foreach($opd as $o)
                                        <option {{ old('eks_id_opd') == $o->id_opd ? 'selected':'' }} value="{{ $o->id_opd }}">{{ $o->nama_opd }}</option>
                                    @endforeach
                                    <option value="lain" {{ old('eks_id_opd') == 'lain' ? 'selected' : '' }}>Instansi Lain</option>
                                </select>
                                @error('eks_id_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3" id="eks-dari-lain">
                            <label class="form-label col-md-3 col-form-label"></label>
                            <div class="col">
                                <input type="text" name="eks_dari" id="eks_dari" value="{{ old('eks_dari') }}" class="form-control @error('eks_dari') is-invalid @enderror" placeholder="Masukkan Nama Instansi..">
                                @error('eks_dari')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Surat Tertanda</label>
                            <div class="col">
                                <input type="text" name="eks_tertanda" id="eks_tertanda" value="{{ old('eks_tertanda') }}" class="form-control @error('eks_tertanda') is-invalid @enderror" placeholder="Masukkan Surat tertanda..">
                                @error('eks_tertanda')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Surat Teruskan</label>
                            <div class="col">
                                <input type="text" name="eks_teruskan" id="eks_teruskan" value="{{ old('eks_teruskan') }}" class="form-control @error('eks_teruskan') is-invalid @enderror" placeholder="Masukkan Surat teruskan..">
                                @error('eks_teruskan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Lampiran Surat</label>
                            <div class="col">
                                <input type="file" name="eks_file_lampiran" id="eks_file_lampiran" value="{{ old('eks_file_lampiran') }}" class="form-control @error('eks_file_lampiran') is-invalid @enderror" placeholder="Masukkan Lampiran Surat..">
                                @error('eks_file_lampiran')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Surat Perihal</label>
                            <div class="col">
                                <input type="text" name="eks_perihal" id="eks_perihal" value="{{ old('eks_perihal') }}" class="form-control @error('eks_perihal') is-invalid @enderror" placeholder="Masukkan Perihal Surat..">
                                @error('eks_perihal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Isi Surat</label>
                            <div class="col">
                                <textarea name="eks_isi" id="eks_isi" class="form-control @error('eks_isi') is-invalid @enderror" placeholder="Masukkan Isi Surat.." rows="10">{{ old('eks_isi') }}</textarea>
                                @error('eks_isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="hr-text hr-text-left">Status Surat</div>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_status') == 'Masuk') checked @endif type="radio" name="eks_status" value="Masuk" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_status') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>

                                                <strong>Masuk</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_status') == 'Tembusan') checked @endif type="radio" name="eks_status" value="Tembusan" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_status') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Tembusan</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_status') == 'Disposisi') checked @endif type="radio" name="eks_status" value="Disposisi" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_status') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Disposisi</strong>
                                            </div>
                                        </div>
                                    </label>
                                    @error('eks_status')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div id="opd-select" class="mt-2">

                                    <select name="tujuan[]" id="tujuan" class="form-control select2 @error('tujuan') is-invalid @enderror" multiple>
                                        <option></option>
                                        @foreach($opd as $o)
                                            <option {{ (collect(old('tujuan'))->contains($o->id_opd)) ? 'selected':'' }} value="{{ $o->id_opd }}">{{ $o->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-hint">Biarkan <b>kosong</b> apabila surat hanya ingin disimpan.</div>
                                    @error('tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-2">
                                        <label for="">Tanggal Disposisi</label>
                                        <input type="date" name="dis_tgl" class="form-control @error('dis_tgl') is-invalid @enderror" value="{{ old('dis_tgl') }}">
                                        @error('dis_tgl')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="">Catatan Disposisi</label>
                                        <textarea name="dis_catatan" class="form-control @error('dis_catatan') is-invalid @enderror">{{ old('dis_catatan') }}</textarea>
                                        @error('dis_catatan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="hr-text hr-text-left">Pengirim Surat</div>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_pengirim') == 'Diketahui') checked @endif type="radio" name="eks_pengirim" value="Diketahui" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_pengirim') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>

                                                <strong>Diketahui</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_pengirim') == 'Tidak Diketahui') checked @endif type="radio" name="eks_pengirim" value="Tidak Diketahui" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_pengirim') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Tidak Diketahui</strong>
                                            </div>
                                        </div>
                                    </label>
                                    @error('eks_pengirim')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="hr-text hr-text-left">Karateristik Surat</div>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_karakteristik') == 'Surat Biasa') checked @endif type="radio" name="eks_karakteristik" value="Surat Biasa" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_karakteristik') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>

                                                <strong>Surat Biasa</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_karakteristik') == 'Surat Terbatas') checked @endif type="radio" name="eks_karakteristik" value="Surat Terbatas" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_karakteristik') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Surat Terbatas</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_karakteristik') == 'Surat Sangat Rahasia') checked @endif type="radio" name="eks_karakteristik" value="Surat Sangat Rahasia" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_karakteristik') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Surat Sangat Rahasia</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_karakteristik') == 'Surat Rahasia') checked @endif type="radio" name="eks_karakteristik" value="Surat Rahasia" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_karakteristik') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Surat Rahasia</strong>
                                            </div>
                                        </div>
                                    </label>
                                    @error('eks_karakteristik')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="hr-text hr-text-left">Derajat Surat</div>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_derajat') == 'Biasa') checked @endif type="radio" name="eks_derajat" value="Biasa" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_derajat') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>

                                                <strong>Biasa</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_derajat') == 'Segera') checked @endif type="radio" name="eks_derajat" value="Segera" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_derajat') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>

                                                <strong>Segera</strong>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input @if(old('eks_derajat') == 'Sangat Segera') checked @endif type="radio" name="eks_derajat" value="Sangat Segera" class="form-selectgroup-input">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3 @error('eks_derajat') border-danger @enderror">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>

                                                <strong>Sangat Segera</strong>
                                            </div>
                                        </div>
                                    </label>
                                    @error('eks_derajat')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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
            if($('input[name="eks_status"]:checked').val() === 'Disposisi')
            {
                $('#opd-select').show()
            } else {
                $('#opd-select').hide();
            }
            if($('select[name="eks_id_opd"]').val() === 'lain')
            {
                $('#eks-dari-lain').show()
            } else {
                $('#eks-dari-lain').hide();
            }


            $('input[name="eks_status"]').change(function () {
                var value = $(this).val();
                if(value == 'Disposisi') {
                    $('#opd-select').show();
                } else {
                    $('#opd-select').hide();
                }
            })
            $('select[name="eks_id_opd"]').change(function () {
                var value = $(this).val();
                if(value == 'lain') {
                    $('#eks-dari-lain').show();
                } else {
                    $('#eks-dari-lain').hide();
                }
            })
        })
    </script>
@endpush
