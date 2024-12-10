<?php

namespace App\Services;

use App\Jobs\SendNotificationDisposisi;
use App\Models\Disposisis;
use App\Models\OPD;
use App\Models\Settings;
use App\Models\SuratEksternal;
use App\Models\SuratKeluar;
use App\Models\TandaTangan;
use App\Models\User;
use App\PDF\PDFFooter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Tcpdf\Fpdi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;

class SuratKeluarService {
    public function update($id, $data)
    {
        $surat = SuratKeluar::find($id);
        if(isset($data['berkas'])){
            if ($data['berkas'] != null && $surat->berkas != null && Storage::exists($surat->berkas)) {
                Storage::delete($surat->berkas);
            }
            $data['berkas'] = Storage::putFile('public/berkas', $data['berkas']);
            $this->placeQRtoPDF($data['berkas'], $surat->qrcode);
        }

        if (isset($data['tujuan'])) {
        $arrTujuan = array();
            foreach ($data['tujuan'] as $val) {
                $find = Disposisis::where('dis_no_surat', $surat->no_surat)->where('dis_tujuan', $val)->whereNull('parent_id')->exists();
                if (!$find) {
                    $tujuan = new Disposisis([
                        'dis_no_surat' => $data['no_surat'],
                        'dis_tgl' => $data['tgl_dikirim'],
                        'dis_tujuan' => $val,
                        'dis_status' => 'Dikirim',
                        'dis_catatan' => 'Surat dikirim.',
                    ]);
                    SendNotificationDisposisi::dispatchAfterResponse($surat->no_surat, $surat->perihal, $surat->tgl_surat, $val);
                    array_push($arrTujuan, $tujuan);
                }
            }

            if (count($arrTujuan) != 0)
                $surat->opds()->saveMany($arrTujuan);

            unset($data['tujuan']);
        }
        $update = SuratKeluar::where('id_qr', $id)->update($data);
        if($update)
            return true;
        else
            return false;
    }

    public function create($data) {

        if(isset($data['berkas'])){
            $data['berkas'] = Storage::putFile('public/berkas', $data['berkas']);
        }


        $insert = SuratKeluar::create([
            'no_surat' => $data['no_surat'],
            'tgl_dikirim' => $data['tgl_dikirim'],
            'tgl_surat' => $data['tgl_surat'],
            'kepada' => $data['kepada'],
            'lampiran' => $data['lampiran'],
            'perihal' => $data['perihal'],
            'id_jenis_ttd_fk' => $data['id_jenis_ttd_fk'],
            'berkas' => $data['berkas'],
            'created_by' => auth()->id()
        ]);
        if($insert) {
            $url = url('surat/detail/'.Hashids::encode($insert->id_qr));
//QR BERWARNA            QrCode::format('png')->size(500)->color(255, 245, 0, 100)->backgroundColor(255, 0, 0, 100)->mergeString(Storage::get('public/images/LOGO_KABUPATEN_TULANG_BAWANG.png'))->generate($url, storage_path('app/public/qr/'.Hashids::encode($insert->id_qr).'.png'));
            QrCode::format('png')->size(500)->merge(Storage::url('app/public/images/LOGO_KABUPATEN_TULANG_BAWANG.png'))->generate($url, storage_path('app/public/qr/'.Hashids::encode($insert->id_qr).'.png'));
            $insert->qrcode = 'public/qr/'.Hashids::encode($insert->id_qr).'.png';

            if(isset($data['berkas'])) {
                $this->placeQRtoPDF($data['berkas'], $insert->qrcode);
            }


            $insert->save();
            //KETIKA MEMAKAI TBL PENERIMA OPD
//            $insert->opd()->attach($data['tujuan']);

            if (isset($data['tujuan'])) {
                $arrTujuan = array();
                foreach ($data['tujuan'] as $val) {
                    $tujuan = new Disposisis([
                        'dis_no_surat' => $data['no_surat'],
                        'dis_tgl' => $data['tgl_dikirim'],
                        'dis_tujuan' => $val,
                        'dis_status' => 'Dikirim',
                        'dis_catatan' => 'Surat dikirim.',
                    ]);
                    SendNotificationDisposisi::dispatchAfterResponse($insert->no_surat, $insert->perihal, $insert->tgl_surat, $val);
                    array_push($arrTujuan, $tujuan);
                }

                $insert->opds()->saveMany($arrTujuan);
            }
        }
        return $insert;
    }

    public function delete($id) {
        $surat = SuratKeluar::find($id);
        if ($surat->berkas != null && Storage::exists($surat->berkas)) {
            Storage::delete($surat->berkas);
        }
        if ($surat->qrcode != null && Storage::exists($surat->qrcode)) {
            Storage::delete($surat->qrcode);
        }
        $surat->disposisi()->delete();
        return $surat->delete();
    }

    public function deleteBulk($ids) {
        $surat = SuratKeluar::whereIn('id_qr', $ids)->get(['berkas', 'qrcode']);
        foreach ($surat as $us) {
            if ($us->berkas != null && Storage::exists($us->berkas)) {
                Storage::delete($us->berkas);
            }
            if ($us->qrcode != null && Storage::exists($us->qrcode)) {
                Storage::delete($us->qrcode);
            }
        }
        return SuratKeluar::destroy($ids);
    }

    public function statusBulk($status, $ids) {

        $update = SuratEksternal::whereIn('eks_id', $ids)->update([
            'eks_status' => $status
        ]);

        return $update;
    }


    public function placeQRtoPDF($berkasPath, $qrCodeUrl) {

        $data['qr'] = $qrCodeUrl;
        $data['link'] = env('APP_URL');
        $pdf = new PDFFooter('P', 'mm', 'A4', true, 'UTF-8', false, false, $data);
        $pdf->setPrintHeader(false);
        $pages = $pdf->setSourceFile(storage_path('app/' . $berkasPath));

        for ($i = 1; $i <= $pages; $i++) {
            $pdf->AddPage();
            /*if ($i == 1) {
                $x_pos = $pdf->GetX();
                $y_pos = $pdf->GetY();
//                        dd($x_pos, $y_pos - 54);
                $pdf->SetXY($x_pos - 10, $y_pos - 48);
                $toolcopy = '<img src="' . Storage::url($qrCodeUrl) . '" width="50" height="50"/>';
                $pdf->writeHTML($toolcopy, true, 0, true, 0);
            }*/
            $page = $pdf->importPage($i);
            $pdf->useTemplate($page, 0, 0);
        }

        $pdf->Output(storage_path('app/'.$berkasPath), "F");
    }
}
