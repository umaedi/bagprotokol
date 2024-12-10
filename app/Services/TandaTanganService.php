<?php

namespace App\Services;

use App\Models\OPD;
use App\Models\Settings;
use App\Models\TandaTangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TandaTanganService {
    public function update($id, $data)
    {
        $tanda = TandaTangan::find($id);

        if(isset($data['jenis_ttd']))
            $tanda->jenis_ttd = $data['jenis_ttd'];
        if(isset($data['active']))
            $tanda->active = $data['active'];

        $save = $tanda->save();
        if($save)
            return true;
        else
            return false;
    }

    public function create($data) {
        $insert = TandaTangan::create($data);
        return $insert;
    }

    public function delete($id) {
        $tanda = TandaTangan::find($id);
        $destroy = $tanda->delete();
        return $destroy;
    }

    public function deleteBulk($ids) {
        $destroy = TandaTangan::destroy($ids);
        return $destroy;
    }

    public function statusBulk($status, $ids) {
        if($status == 'aktif') {
            $status = 1;
        } else {
            $status = 0;
        }

        $update = TandaTangan::whereIn('id_jenis_ttd', $ids)->update([
            'active' => $status
        ]);

        return $update;
    }
}
