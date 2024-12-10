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

            <form action="{{ url('agenda/print') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-status-start bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">Form Isian Cetak Agenda</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label class="form-label col-md-3 col-form-label">Tanggal Agenda</label>
                        <div class="col">
                            <input type="date" name="agenda_tanggal" id="agenda_tanggal" value="{{ old('agenda_tanggal') }}" class="form-control @error('agenda_tanggal') is-invalid @enderror" placeholder="Masukkan Tanggal Agenda..">
                            @error('agenda_tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{--<div class="form-group row mb-3">
                        <label class="form-label col-md-3 col-form-label">Pejabat Pendandatangan</label>
                        <div class="col">
                            <select name="agenda_ttd" id="agenda_ttd" class="form-control select2 @error('agenda_ttd') is-invalid @enderror">
                                <option>- Pilih -</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('agenda_ttd')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>--}}
                    <div class="form-group row mb-3">
                        <label class="form-label col-md-3 col-form-label">Margin(mm) (atas, bawah, kiri, kanan)</label>
                        <div class="col">
                            <input type="text" name="margin" id="margin" value="{{ old('margin') }}" class="form-control @error('margin') is-invalid @enderror" placeholder="Masukkan margin print..">
                            @error('margin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-auto align-self-center">
                                  <span class="form-help" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<p>Format isian harus seperti ini dalam ukuran milimeter <b>3,3,2,2</b></p>" data-bs-html="true" data-bs-original-title="" title="" aria-describedby="popover554801">?</span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="form-label col-md-3 col-form-label">Pilih Kertas</label>
                        <div class="col">
                            <select name="agenda_kertas" id="agenda_kertas" class="form-control select2 @error('agenda_kertas') is-invalid @enderror">
                                <option>- Pilih -</option>
                                <option value="a4">A4</option>
                                <option value="F4">F4</option>
                            </select>
                            @error('agenda_kertas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button name="type" type="submit" value="download" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <line x1="12" y1="11" x2="12" y2="17" />
                            <polyline points="9 14 12 17 15 14" />
                        </svg>
                        Download</button>
                    <button type="submit" value="print" name="type" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <rect x="7" y="13" width="10" height="8" rx="2" />
                        </svg>
                        Print</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
@endpush
