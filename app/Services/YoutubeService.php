<?php

namespace App\Services;

use App\Models\OPD;
use App\Models\Settings;
use App\Models\TandaTangan;
use App\Models\User;
use App\Models\Youtube;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class YoutubeService {
    public function update($id, $data)
    {
        $yt = Youtube::find($id);

        if(isset($data['title']))
            $yt->title = $data['title'];
        if(isset($data['desc']))
            $yt->desc = $data['desc'];
        if(isset($data['url']))
            $yt->url = $data['url'];
        if(isset($data['active']))
            $yt->active = $data['active'];

        /*if(isset($data['picture'])){
            if ($data['picture'] != null && $yt->picture != null && Storage::exists($yt->picture)) {
                Storage::delete($yt->picture);
            }
            $yt->picture = Storage::putFile('public/images', $data['picture']);
        }*/

        $save = $yt->save();
        if (isset($data['kategori']))
            $yt->kategori()->sync($data['kategori']);
        if($save)
            return true;
        else
            return false;
    }

    public function create($data) {
        /*if(isset($data['picture'])){
            $data['picture'] = Storage::putFile('public/images', $data['picture']);
        }*/
        $insert = Youtube::create($data);
        if (isset($data['kategori']))
            $insert->kategori()->sync($data['kategori']);

        return $insert;
    }

    public function delete($id) {
        $yt = Youtube::find($id);
        $destroy = $yt->delete();
        return $destroy;
    }

    public function deleteBulk($ids) {
        $destroy = Youtube::destroy($ids);
        return $destroy;
    }

    public function statusBulk($status, $ids) {
        if($status == 'aktif') {
            $status = '1';
        } else {
            $status = '0';
        }

        $update = Youtube::whereIn('id', $ids)->update([
            'active' => $status
        ]);

        return $update;
    }
}
