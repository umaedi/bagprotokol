<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Agenda Bupati Tuba Tanggal {{ \Carbon\Carbon::parse($tanggal)->isoFormat('D MMMM YYYY')}}</title>
    <style>
        @foreach($css as $path)
          {{ File::get($path) }}
        @endforeach
        td {
            padding: 5px !important;
        }

        @font-face {
            font-family: "Roboto";
        url("/print/OpenSans-Regular.ttf") format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: "Roboto";
        url("/print/OpenSans-Bold.ttf") format('truetype');
            font-weight: 700;
            font-style: normal;
        }

        body {
            font-family: "Open Sans";
            letter-spacing: 1px;
        }

        .table-bordered > tbody > tr > td {
            border-bottom: 0;
            border-top: 0;
        }
    </style>
</head>
<body>
<div class="text-center">
    <img style="text-align: center" width="75"
         src="data:image/png;base64,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"
         alt="">
</div>
<h5 style="text-align: center;" class="text-uppercase mb-0 mt-1">Agenda Harian</h5>
<h5 class="text-uppercase" style="text-align: center; font-weight: 700; font-size: 1.4rem">
    BULAN {{ \Carbon\Carbon::parse($tanggal)->isoFormat('MMMM YYYY') }} </h5>
<p style="font-weight: bold; font-size: 0.8rem; margin-bottom: 0">HARI
    : {{ \Illuminate\Support\Str::upper(\Carbon\Carbon::parse($tanggal)->isoFormat('dddd')) }}<br>
    TANGGAL : {{ \Illuminate\Support\Str::upper(\Carbon\Carbon::parse($tanggal)->isoFormat('D MMMM YYYY')) }}</p>
<table class="table table-bordered" style="font-size: 12px;">
    <thead>
    <tr>
        <th class="text-center" width="2%">NO</th>
        <th class="text-center">KEGIATAN</th>
        <th class="text-center" width="2%">JAM</th>
        <th class="text-center">TEMPAT</th>
        <th class="text-center">PAKAIAN</th>
        <th class="text-center">KETERANGAN</th>
    </tr>
    </thead>
    <tbody>
    @foreach($agendas as $ag)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $ag->agenda_nama }}</td>
            <td class="text-center">{{ \Carbon\Carbon::createFromFormat('H:i:s',$ag->agenda_waktu)->format('H:i') }}</td>
            <td width="20%">{{ $ag->agenda_lokasi }}</td>
            <td width="20%" class="text-center">{{ $ag->agenda_pakaian }}</td>
            <td width="25%">
                <span style="font-weight: bold;padding-left: 5%">{{ $ag->agenda_pejabat }}</span><br>
                {{--@php
                    $undangans = explode(',', $ag->agenda_undangan)
                @endphp
                <ul style="margin-left: 0;">
                    @foreach($undangans as $u)
                        <li style="margin-left: 0">{{ trim($u) }}</li>
                    @endforeach
                </ul>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12">
        <p>Catatan : Jadwal Kegiatan Sewaktu-waktu dapat berubah</p>
    </div>
</div>
<table width="100%">
    <tr>
        <td style="width: 50%" class="text-center">
            <div class="text-center" style="display: inline-block">
                <br><br>
                <p class="font-weight-bold">{{ \Illuminate\Support\Str::upper($tanda_tangan->nama_jabatan_bag) }}</p>
                <br>
                <br>
                <span class="font-weight-bold text-nowrap" style="text-decoration: underline">{{ $tanda_tangan->nama_pejabat_bag }}</span><br>
                <span>{{ $tanda_tangan->pangkat_bag }}</span><br>
                <span>NIP. {{ $tanda_tangan->nip_pejabat_bag }}</span>
            </div>
        </td>
        <td style="width: 50%" class="text-center">
            <div class="text-center" style="display: inline-block;">
                <span>Tulang Bawang, {{ now()->isoFormat('D MMMM YYYY') }}</span><br><br>
                <p class="font-weight-bold">{{ \Illuminate\Support\Str::upper($tanda_tangan->nama_jabatan_sub) }}</p>
                <br>
                <br>
                <span class="font-weight-bold text-nowrap" style="text-decoration: underline">{{ $tanda_tangan->nama_pejabat_sub }}</span><br>
                <span>{{ $tanda_tangan->pangkat_sub }}</span><br>
                <span>NIP. {{ $tanda_tangan->nip_pejabat_sub }}</span>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
