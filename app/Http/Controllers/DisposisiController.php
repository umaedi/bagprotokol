<?php

namespace App\Http\Controllers;

use App\Models\OPD;
use App\Models\SuratEksternal;
use App\Models\SuratKeluar;
use App\Services\DisposisiService;
use App\Services\SuratEksternalService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;

class DisposisiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->disposisiService = new DisposisiService();
    }

    public function getIndex() {

        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $opd = auth()->user()->opd()->first();
            if(\request()->type == 'internal') {
                $surat = SuratKeluar::whereHas('disposisi', function ($q) use ($opd) {
                    $q->where('tb_disposisi.dis_tujuan', $opd->id_opd);
                });
                $fields = ['no_surat'];
            } else {
                $surat = SuratEksternal::whereHas('disposisi', function ($q) use ($opd) {
                    $q->where('tb_disposisi.dis_tujuan', $opd->id_opd);
                });
                $fields = ['eks_nosurat'];
            }

            if(request()->search != '') {
                foreach ($fields as $key => $value) {
                    if($key == 0)
                        $surat->where($value, 'like', '%'. request()->search . '%');
                    else
                        $surat->orWhere($value, 'like', '%'. request()->search . '%');

                }
            }

            $data['table'] = $surat->latest()->paginate($page);
            if(\request()->type == 'internal') {
                return view('disposisi._table_data_internal', $data);
            } else {
                return view('disposisi._table_data_eksternal', $data);
            }
        }

        $data = [
            'title' => 'List Surat Disposisi',
            'descTitle' => 'Seluruh surat disposisi di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Surat Disposisi', 'active' => true],
            ],
        ];

        return view('disposisi.index', $data);
    }

    /*public function getEksternal($id) {
        $id = Hashids::decode($id)[0];

        $data = [
            'title' => 'Disposisi Surat',
            'descTitle' => 'Silahkan disposisikan surat yang anda terima',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => 'surat/disposisi' , 'name' => 'Surat Disposisi', 'active' => true],
                ['url' => '#' , 'name' => 'Disposisi', 'active' => true],
            ],
            'surat' => SuratEksternal::find($id),
            'opd' => OPD::where('active', 1)->get()
        ];

        return view('disposisi.disposisi_eksternal', $data);
    }*/

    public function postEksternal($id = null, Request $request) {
        $id = Hashids::decode($id)[0];
        DB::beginTransaction();
        try {
            $insert = $this->disposisiService->disposisiSurat($id, $request->all());
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Surat Eksternal gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();
        $surat = SuratEksternal::where('eks_nosurat', $insert['dis_no_surat'])->first();

        $msg['success'] = true;
        $msg['message'] = 'Surat berhasil disposisi!';
        Session::flash('feedback', $msg);
        return redirect()->to('/surat/eksternal/detail/'.Hashids::encode($surat->eks_id));
    }

    public function detailInternalDis($id,$disID = null) {
        if (!$disID)
            $disID = $id;
        $id = Hashids::decode($id)[0];

        $data = [
            'title' => 'Disposisi Surat',
            'descTitle' => 'Silahkan disposisikan surat yang anda terima',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Disposisi', 'active' => true],
            ],
            'surat' => SuratKeluar::find($id),
            'disID' => $disID,
            'opd' => OPD::where('active', 1)->get()
        ];

        return view('disposisi.disposisi_internal', $data);
    }
    public function detailEksternalDis($id,$disID = null) {
        if (!$disID)
            $disID = $id;
        $id = Hashids::decode($id)[0];

        $data = [
            'title' => 'Disposisi Surat',
            'descTitle' => 'Silahkan disposisikan surat yang anda terima',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Disposisi', 'active' => true],
            ],
            'surat' => SuratEksternal::find($id),
            'disID' => $disID,
            'opd' => OPD::where('active', 1)->get()
        ];

        return view('disposisi.disposisi_eksternal', $data);
    }

    public function postInternal($id = null, Request $request) {
        $id = Hashids::decode($id)[0];
        DB::beginTransaction();
        try {
            $insert = $this->disposisiService->disposisiSurat($id, $request->all());
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Surat Internal gagal disposisi!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $surat = SuratKeluar::where('no_surat', $insert->dis_no_surat)->first();
        $msg['success'] = true;
        $msg['message'] = 'Surat berhasil disposisi!';
        Session::flash('feedback', $msg);
        return redirect()->to('/surat/detail/'.Hashids::encode($surat->id_qr));
    }

    public function putTerima($id)
    {
        DB::beginTransaction();
        try {
            $this->disposisiService->terima($id);
        } catch (QueryException $e) {
            DB::rollBack();
            $msg['success'] = false;
            $msg['message'] = 'Gagal menerima surat!';
            return response()->json($msg, 500);
        }

        DB::commit();
        $msg['success'] = true;
        $msg['message'] = 'Berhasil menerima surat!';
        return response()->json($msg, 200);
    }
}
