<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\OPD;
use App\Models\Settings;
use App\Models\TandaTangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AgendaService {
    public function update($id, $data)
    {
        $age = Agenda::find($id);
        $age->agenda_nama = $data['agenda_nama'];
        $age->agenda_lokasi = $data['agenda_lokasi'];
        $age->agenda_pejabat = $data['agenda_pejabat'];
        $age->agenda_waktu = $data['agenda_waktu'];
        $age->agenda_pakaian = $data['agenda_pakaian'];
//        $age->agenda_undangan = $data['agenda_undangan'];
        $age->agenda_tgl_mulai = Carbon::createFromFormat('d/m/Y', $data['agenda_tgl_mulai'])->format('Y-m-d');
//        $age->agenda_tgl_akhir = Carbon::createFromFormat('d/m/Y', $data['agenda_tgl_akhir'])->format('Y-m-d');

        $save = $age->save();
        if($save)
            return true;
        else
            return false;
    }

    public function create($data) {
        $data['agenda_tgl_mulai'] = Carbon::createFromFormat('d/m/Y', $data['agenda_tgl_mulai'])->format('Y-m-d');
//        $data['agenda_tgl_akhir'] = Carbon::createFromFormat('d/m/Y', $data['agenda_tgl_akhir'])->format('Y-m-d');
        $insert = Agenda::create($data);
        return $insert;
    }

    public function delete($id) {
        $age = Agenda::find($id);
        $destroy = $age->delete();
        return $destroy;
    }

    public function deleteBulk($ids) {
        $destroy = Agenda::destroy($ids);
        return $destroy;
    }
}
