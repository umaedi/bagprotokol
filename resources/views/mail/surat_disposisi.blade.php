<html lang="id">
<body>
<h2>Informasi Pemberitahuan Surat Disposisi</h2>
<span>Yth. Bapak/Ibu</span>,<br>
<span>Berikut ini kami sampaikan informasikan bahwa anda telah menerima sebuah surat dengan informasi sebagai berikut: </span><br>

<ul>
    <li>Nomor Surat : {{ $noSurat }}</li>
    <li>Perihal : {{ $perihal }}</li>
    <li>Tanggal Surat : {{ \Carbon\Carbon::parse($tanggalSurat)->isoFormat('dddd, D MMMM YYYY') }}</li>
</ul>
<br>
<span>Untuk melihat detail surat bisa anda lihat dengan membuka aplikasi seruIT</span>
<br>
<p>Salam Hormat,</p>

<b>Administrator Aplikasi {{ env('APP_NAME') }} {{ now()->format('Y') }}</b>

</body>

</html>
