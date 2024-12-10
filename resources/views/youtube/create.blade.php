@extends('layouts.template')
@push('lib-css')
@endpush
@push('css')
@endpush

@section('action-title')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{ url('youtube') }}" class="btn btn-success d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1"></path>
                </svg>
                Kembali
            </a>
            <a href="{{ url('youtube') }}"  class="btn btn-success d-sm-none btn-icon">
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
                <form action="{{ url('youtube') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card">
                    <div class="card-status-start bg-green"></div>
                    <div class="card-header">
                        <h4 class="card-title">Form Isian Youtube</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Judul</label>
                            <div class="col">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan Narasi Judul Youtube..">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Embed ID</label>
                            <div class="col">
                                <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control @error('url') is-invalid @enderror" placeholder="Masukkan id url youtube anda, contoh: 0tmCIsSpvC8">
                                @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-auto align-self-center">
                                <span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-html="true" data-bs-content="<p>Gunakan id url pada fitur <b>Navigasi bar > URL Link Youtube</b>, contohnya: <a href='https://www.youtube.com/embed/0tmCIsSpvC8'>https://www.youtube.com/embed/<b>0tmCIsSpvC8</b></a></p>">?</span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Deskripsi</label>
                            <div class="col">
                                <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror">{{ old('desc') }}</textarea>
                                @error('desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{--<div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Gambar</label>
                            <div class="col">
                                <input type="file" name="picture" id="picture" value="{{ old('picture') }}" class="form-control @error('picture') is-invalid @enderror" placeholder="Masukkan Gambar..">
                                @error('picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>--}}

                        {{--<div class="form-group row mb-3">
                            <label class="form-label col-md-3 col-form-label">Kategori Youtube</label>
                            <div class="col">
                                <select name="kategori[]" id="kategori" class="form-control select2 @error('kategori') is-invalid @enderror" multiple>
                                    <option></option>
                                    @foreach($kategori as $kt)
                                        <option {{ (collect(old('kategori'))->contains($kt->id)) ? 'selected':'' }} value="{{ $kt->id }}">{{ $kt->label }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="hr-text hr-text-left">Status Youtube</div>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                            <label class="form-selectgroup-item flex-fill">
                                <input @if(old('active') == '1') checked @endif type="radio" name="active" value="1" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>

                                        <strong>Aktif</strong>
                                    </div>
                                </div>
                            </label>
                            <label class="form-selectgroup-item flex-fill">
                                <input @if(old('active') != '1') checked @endif type="radio" name="active" value="0" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        <strong>Tidak aktif</strong>
                                    </div>
                                </div>
                            </label>
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
