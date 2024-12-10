@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('opd') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
                Kembali
            </a>
            <a href="{{ url('opd') }}"  class="btn btn-success d-sm-none btn-icon">
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
                <form action="{{ url('opd') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="card-status-start bg-green"></div>
                    <div class="card-header">
                        <h4 class="card-title">Form Isian OPD</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nama OPD</label>
                            <div class="col">
                                <input type="text" name="nama_opd" id="nama_opd" value="{{ old('nama_opd') }}" class="form-control @error('nama_opd') is-invalid @enderror" placeholder="Masukkan nama organisasi..">
                                @error('nama_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Alias Nama OPD</label>
                            <div class="col">
                                <input type="text" name="alias_opd" id="nama_opd" value="{{ old('alias_opd') }}" class="form-control @error('alias_opd') is-invalid @enderror" placeholder="Masukkan nama alias organisasi..">
                                @error('alias_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Alamat OPD</label>
                            <div class="col">
                                <textarea name="alamat_opd" id="alamat_opd" class="form-control @error('alamat_opd') is-invalid @enderror" placeholder="Masukkan alamat organisasi..">{{ old('alamat_opd') }}</textarea>
                                @error('alamat_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Email</label>
                            <div class="col">
                                <input type="email" name="email_opd" id="email_opd" value="{{ old('email_opd') }}" class="form-control @error('email_opd') is-invalid @enderror" placeholder="Masukkan email..">
                                @error('email_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Nomor Telepon</label>
                            <div class="col">
                                <input type="text" name="notelepon_opd" id="notelepon_opd" value="{{ old('notelepon_opd') }}" class="form-control @error('notelepon_opd') is-invalid @enderror" placeholder="Masukkan Nomor Telepon..">
                                @error('notelepon_opd')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="hr-text hr-text-left">Pilih Pengguna OPD</div>
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Pengguna</label>
                            <div class="col">
                                <select name="pengguna" class="form-control select2 @error('pengguna') is-invalid @enderror" id="pengguna">
                                    <option></option>
                                    @foreach($users as $o)
                                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-hint">Biarkan tidak dipilih apabila opd  tidak memiliki pengguna</small>
                                @error('pengguna')
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
@endpush
