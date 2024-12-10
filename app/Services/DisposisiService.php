<?php

namespace App\Services;

use App\Jobs\SendNotificationDisposisi;
use App\Models\Disposisi;
use App\Models\Disposisis;
use App\Models\OPD;
use App\Models\Settings;
use App\Models\SuratEksternal;
use App\Models\SuratKeluar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DisposisiService {
    public function disposisiEksternal($id, $data) {
        $surat = SuratEksternal::find($id);
        $opd = auth()->user()->opd()->first();

        $prevDis = Disposisi::where('dis_no_surat', $surat->eks_nosurat)->where('dis_tujuan', $opd->id_opd)->latest()->first();
        if($prevDis) {
            $disAsal = $prevDis->dis_asal;
        } else {
            $disAsal = $opd->id_opd;
        }

        if($data['dis_status'] == 'Tindak Lanjut') {
            $data['dis_tujuan'] = $opd->id_opd;
        }

        $insert = Disposisi::create([
           'dis_no_surat' => $surat->eks_nosurat,
           'dis_tgl' => now(),
           'dis_asal' => $disAsal,
           'dis_tujuan' => $data['dis_tujuan'],
           'dis_catatan' => $data['dis_catatan'],
           'dis_status' => $data['dis_status'],
           'dis_tgl_terima' => $data['dis_tgl_terima'],
        ]);

        if($data['dis_status'] != 'Tindak Lanjut') {
            SendNotificationDisposisi::dispatchAfterResponse($surat->eks_nosurat, $surat->eks_perihal, $surat->eks_tgl_surat, $data['dis_tujuan']);
        }
        if($insert)
            return true;
        else
            return false;
    }
    public function disposisiSurat($id, $data)
    {
        $surat = Disposisis::find($id);
        if($surat->dis_tgl_terima == null) {
            $surat->dis_tgl_terima = now();
            $surat->save();
        }
        $no_surat = $surat->dis_no_surat;
        if(in_array(auth()->user()->level, [env('role_admin'), env('role_superadmin'), env('role_surat')])) {
            $id = $surat->dis_tujuan;
        } else {
            $opd = auth()->user()->opd()->first();
            $id_opd = $opd->id_opd;
        }


        if ($data['dis_status'] == 'Tindak Lanjut') {
            $data['dis_tujuan'] = [$id_opd];
            $data['dis_tgl_terima'] = now();
        }


        foreach ($data['dis_tujuan'] as $ts) {
             $surat->children()->create([
                'dis_no_surat' => $no_surat,
                'dis_tgl' => now(),
                'dis_tujuan' => $ts,
                'dis_status' => $data['dis_status'],
                'dis_catatan' => $data['dis_catatan'],
                'dis_tgl_terima' => $data['dis_tgl_terima'] ?? null,
            ]);

            if($data['dis_status'] != 'Tindak Lanjut') {
                $suratKeluar = SuratKeluar::where('no_surat', $no_surat)->first();
                SendNotificationDisposisi::dispatchAfterResponse($suratKeluar->no_surat, $suratKeluar->perihal, $suratKeluar->tgl_surat, $ts);
            }
        }

        //INI DIGUNAKAN APABILA PAKAI CARA PENERIMA QRCODE
        /*if (in_array($opd->level_pj, [env('OPD_SEKDA'), env('OPD_GUB')])) {
            if (count($surat->disposisi) == 0) {
                $insert = $this->insertDisposisiBanyak($surat, $data);
            } else {
                $insert = $this->insertDisposisiSingle($surat, $opd, $data);
            }

        } elseif($opd->level_pj == env('OPD_BIASA')) {
            if(count($surat->opd) > 0) {
                $insert = $this->insertDisposisiSingle($surat, $opd, $data);
            } else {
                $insert = $this->insertDisposisiBanyak($surat, $data);
            }
        } elseif($opd->level_pj == env('OPD_BIASA')) {
            $insert = $this->insertDisposisiSingle($surat, $opd, $data);
        }*/

            return $surat;
    }

    //INI DIGUNAKAN APABILA PAKAI CARA PENERIMA QRCODE
    function insertDisposisiSingle($surat, $opd, $data) {
        $prevDis = Disposisi::where('dis_no_surat', $surat->no_surat)->where('dis_tujuan', $opd->id_opd)->latest()->get();
        if ($prevDis) {
            $disAsal = $prevDis->dis_asal;
        } else {
            $disAsal = $opd->id_opd;
        }

        return Disposisi::create([
            'dis_no_surat' => $surat->no_surat,
            'dis_tgl' => now(),
            'dis_asal' => $disAsal,
            'dis_tujuan' => $data['dis_tujuan'],
            'dis_catatan' => $data['dis_catatan'],
            'dis_status' => $data['dis_status'],
            'dis_tgl_terima' => $data['dis_tgl_terima'],
        ]);
    }
    //INI DIGUNAKAN APABILA PAKAI CARA PENERIMA QRCODE
    function insertDisposisiBanyak($surat, $data) {
        $arrPenerima = array();
        foreach ($surat->opd as $ts) {
            array_push($arrPenerima, [
                'dis_no_surat' => $surat->no_surat,
                'dis_tgl' => now(),
                'dis_asal' => $ts->id_opd,
                'dis_tujuan' => $data['dis_tujuan'],
                'dis_status' => $data['dis_status'],
                'dis_catatan' => $data['dis_catatan'],
            ]);
        }

        return Disposisi::insert($arrPenerima);
    }



    public function terima($id)
    {
        $surat = Disposisis::find($id);
//        $surat->dis_status = 'Diterima';
        $surat->dis_tgl_terima = now();
        return $surat->save();
    }

}
