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
                <div class="alert alert-success" role="alert">
                    <div class="d-flex">
                        <div>
                            <span class="avatar float-start me-3" style="background-image: url('@if($user['avatar'] != null) {{ \Illuminate\Support\Facades\Storage::url($user['avatar']) }} @else https://ui-avatars.com/api/?name={{ $user['name'] }} @endif')"></span>
                        </div>
                        <div>
                            <h4 class="alert-title">Hallo {{ $user['name'] }}!</h4>
                            <div class="text-muted">Selamat datang di aplikasi {{ $settings['app_name'] }}, berikut ini preview singkat dari data seluruh aplikasi.</div>
                        </div>
                    </div>
                </div>
            </div>
            @if(in_array($user['level'], [env('ROLE_USER'), env('ROLE_SURAT'), env('ROLE_SUPERADMIN')]))
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                            <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" /> <path d="M3 6l9 6l9 -6" /> <path d="M15 18h6" /> <path d="M18 15l3 3l-3 3" /> </svg>
                            </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $suratkeluar_count }} Surat Keluar
                                </div>
                                <div class="text-muted">
                                    {{ $suratkeluar_today_count == 0 ? 0 : $suratkeluar_today_count }} Surat Keluar hari ini
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                            <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mailbox" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /> <path d="M12 11v-8h4l2 2l-2 2h-4" /> <path d="M6 15h1" /> </svg>
                            </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $suratmasuk_count }} Surat Masuk
                                </div>
                                <div class="text-muted">
                                    {{ $suratmasuk_today_count == 0 ? '0' : $suratkeluar_today_count }} Surat Masuk hari ini
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(in_array($user['level'], [env('ROLE_PROTOKOL'), env('ROLE_SUPERADMIN')]))
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                            <span class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /> <circle cx="18" cy="18" r="4" /> <path d="M15 3v4" /> <path d="M7 3v4" /> <path d="M3 11h16" /> <path d="M18 16.496v1.504l1 1" /> </svg>
                            </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $agenda_count }} Agenda
                                </div>
                                <div class="text-muted">
                                    {{ $agendatoday_count == 0 ? '0' : $suratkeluar_today_count }} Agenda hari ini
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(in_array($user['level'], [env('ROLE_DOKUMENTASI'), env('ROLE_SUPERADMIN')]))
            <div class="col-md-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                            <span class="bg-red text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera-selfie" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /> <path d="M9.5 15a3.5 3.5 0 0 0 5 0" /> <line x1="15" y1="11" x2="15.01" y2="11" /> <line x1="9" y1="11" x2="9.01" y2="11" /> </svg>
                            </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ $foto_count }} Foto
                                </div>
                                <div class="text-muted">
                                    {{ $fototoday_count == 0 ? '0' : $suratkeluar_today_count }} Foto hari ini
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(in_array($user['level'], [env('ROLE_SUPERADMIN'), env(' ROLE_PROTOKOL')]))
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Agenda 7 Hari Ke Depan</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter">
                            @forelse($agenda as $a)
                                <tr>
                                    <td class="w-100">
                                        <a href="{{ url('agenda/edit/' . $a->agenda_id) }}" class="text-reset">
                                            {{ $a->agenda_nama }}
                                        </a>
                                        <p class="font-weight-bold">Lokasi Agenda: {{ $a->agenda_lokasi }}</p>
                                    </td>
                                    <td class="text-nowrap">
                                        Pejabat: {{ $a->agenda_pejabat }}
                                    </td>
                                    <td class="text-nowrap text-muted">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                        {{ \Carbon\Carbon::parse($a->agenda_tgl_mulai)->isoFormat('dddd, D MMMM YYYY') }} {{ $a->agenda_waktu }}
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-muted">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="13" r="7"></circle>
                                                <polyline points="12 10 12 13 14 13"></polyline>
                                                <line x1="7" y1="4" x2="4.25" y2="6"></line>
                                                <line x1="17" y1="4" x2="19.75" y2="6"></line>
                                            </svg>
                                            {{ $a->agenda_waktu }}
                                        </a>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="#" class="text-muted">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hanger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15 7a3 3 0 1 0 -3 3v2m0 0l-8.624 5.488a0.82 .82 0 0 0 .44 1.512h16.368a0.82 .82 0 0 0 .44 -1.512l-8.624 -5.488z"></path>
                                            </svg>
                                            {{ $a->agenda_pakaian }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td class="text-center">Tidak ada agenda</td>
                                </tr>
                            @endforelse
                        </table>
                        <div class="d-flex align-items-center m-2">
                            <p class="m-0 text-muted">Showing <span>{{ $agenda->firstItem() }}</span> to <span>{{ $agenda->lastItem() }}</span> of <span>{{ $agenda->total() }}</span> data</p>
                            @if($agenda->hasMorePages())
                                {{$agenda->onEachSide(1)->links('vendor.pagination.tabler-paging', ['paginator' => $agenda])}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
                @endif

        </div>
    </div>
@endsection

@push('lib-js')
@endpush
@push('js')
@endpush
