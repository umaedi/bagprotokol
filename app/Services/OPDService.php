<?php

namespace App\Services;

use App\Models\OPD;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OPDService {
    public function update($id, $data)
    {
        $opd = OPD::find($id);

        if(isset($data['nama_opd']))
            $opd->nama_opd = $data['nama_opd'];
        if(isset($data['alias_opd']))
            $opd->alias_opd = $data['alias_opd'];
        if(isset($data['alamat_opd']))
            $opd->alamat_opd = $data['alamat_opd'];
        if(isset($data['email_opd']))
            $opd->email_opd = $data['email_opd'];
        if(isset($data['notelepon_opd']))
            $opd->notelepon_opd = $data['notelepon_opd'];
        if(isset($data['active']))
            $opd->active = $data['active'];

        if(isset($data['pengguna']) && $data['pengguna'] != null) {
            $opd->id_user = $data['pengguna'];
        }

        $save = $opd->save();
        if($save)
            return true;
        else
            return false;
    }

    public function create($data) {

        $data['active'] = '1';

        $insert = OPD::create($data);
        if ($insert) {
            if (isset($data['pengguna']) && $data['pengguna'] != null) {
                $opd = User::find($data['pengguna']);
                $insert->id_user = $opd->id;
                $opd->save();
            }
        }
    }

    public function changePassword($data)
    {
        $user = User::find(auth()->id());

        if(isset($data['password']))
            $user->password = Hash::make($data['password']);

        $save = $user->save();
        if($save)
            return true;
        else
            return false;
    }

    public function delete($id) {
        $opd = OPD::find($id);
        $destroy = $opd->delete();
        return $destroy;
    }

    public function deleteBulk($ids) {
        $destroy = OPD::destroy($ids);
        return $destroy;
    }

    public function statusBulk($status, $ids) {
        if($status == 'aktif') {
            $status = 1;
        } else {
            $status = 0;
        }

        $update = OPD::whereIn('id_opd', $ids)->update([
            'active' => $status
        ]);

        return $update;
    }
}
