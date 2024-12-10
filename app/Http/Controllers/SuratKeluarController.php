<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Disposisis;
use App\Models\OPD;
use App\Models\SuratEksternal;
use App\Models\SuratKeluar;
use App\Models\TandaTangan;
use App\Models\User;
use App\Services\OPDService;
use App\Services\SuratEksternalService;
use App\Services\SuratKeluarService;
use App\Services\TandaTanganService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Vinkla\Hashids\Facades\Hashids;

class SuratKeluarController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.role:surat,user');
        $this->suratKeluarService = new SuratKeluarService();
    }

    public function getIndex() {
        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $surat = SuratKeluar::query();
            if (auth()->user()->level == env('role_surat'))
                $surat->where('created_by', auth()->id());
            $fields = ['no_surat'];

            if(request()->search != '') {
                foreach ($fields as $key => $value) {
                    if($key == 0)
                        $surat->where($value, 'like', '%'. request()->search . '%');
                    else
                        $surat->orWhere($value, 'like', '%'. request()->search . '%');

                }
            }
            if(request()->status != '' && \request()->status != 'all') {
                $surat->where('status', \request()->status);
            }

            $data['table'] = $surat->latest()->paginate($page);
            return view('suratkeluar._table_data', $data);
        }
        $data = [
            'title' => 'List Surat Keluar',
            'descTitle' => 'Seluruh surat keluar di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Surat Keluar', 'active' => true],
            ],
        ];

        return view('suratkeluar.index', $data);
    }

    public function getCreate() {
        $data = [
            'title' => 'Tambah Surat Keluar',
            'descTitle' => 'Halaman ini berfungsi untuk menambahkan surat keluar di '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/surat/eksternal' , 'name' => 'Surat Keluar'],
                ['url' => '#' , 'name' => 'Tambah Surat Keluar', 'active' => true],
            ],
            'ttd' => TandaTangan::where('active', '1')->get(),
            'opd' => OPD::where('active', '1')->get()
        ];
        return view('suratkeluar.create', $data);
    }

    public function postIndex(Request $request) {
        $suratRule = SuratKeluar::$rules;
        $suratAttr = SuratKeluar::$attributeRule;
        $this->validate($request, $suratRule, [], $suratAttr);

        try {
            $this->suratKeluarService->create($request->except(['_token']));
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Surat Keluar gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Surat Keluar berhasil dibuat!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function deleteIndex($id) {
        DB::beginTransaction();
        try {
            $this->suratKeluarService->delete($id);
        } catch (QueryException $e) {
            DB::rollBack();
            $msg['success'] = false;
            $msg['message'] = 'Gagal menghapus data!';
            return response()->json($msg, 500);
        }

        DB::commit();
        $msg['success'] = true;
        $msg['message'] = 'Berhasil menghapus data!';
        return response()->json($msg, 200);
    }

    public function getEdit($id) {
        $data = [
            'title' => 'Edit Surat Keluar',
            'descTitle' => 'Halaman ini berfungsi untuk mengubah data surat keluar',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/surat/keluar' , 'name' => 'Surat Keluar'],
                ['url' => '#' , 'name' => 'Edit Surat Keluar', 'active' => true],
            ],
            'edit' => SuratKeluar::find($id),
            'ttd' => TandaTangan::where('active', '1')->get(),
            'opd' => OPD::where('active', '1')->get(),
        ];
        return view('suratkeluar.edit', $data);
    }

    public function putIndex($id, Request $request) {
        $suratRule = SuratKeluar::$rules;
        $suratRule['berkas'] = 'mimes:pdf|max:1024';
        $suratAttr = SuratKeluar::$attributeRule;
        $this->validate($request, $suratRule, [], $suratAttr);

        DB::beginTransaction();

        try {
            $this->suratKeluarService->update($id, $request->except(['_token', '_method']));
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, surat eksternal gagal diubah!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Surat eksternal berhasil diubah!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function postBulkDelete() {
        DB::beginTransaction();
        try {
            $this->suratKeluarService->deleteBulk(\request()->ids);
        } catch (QueryException $e) {
            DB::rollBack();
            $msg['success'] = false;
            $msg['message'] = 'Maaf, terjadi kegagalan dalam menghapus data!';
            return response()->json($msg, 200);
        }

        DB::commit();
        $msg['icon'] = 'success';
        $msg['success'] = true;
        $msg['message'] = 'Berhasil menghapus data!';
        return response()->json($msg, 200);
    }

    public function postBulkStatus() {
        DB::beginTransaction();
        try {
            $this->suratEksternalService->statusBulk(request()->status, \request()->ids);
        } catch (QueryException $e) {
            DB::rollBack();
            $msg['success'] = false;
            $msg['icon'] = 'error';
            $msg['message'] = 'Maaf, terjadi kegagalan dalam mengganti status data!';
            return response()->json($msg, 200);
        }

        DB::commit();
        $msg['success'] = true;
        $msg['icon'] = 'success';
        $msg['message'] = 'Berhasil mengganti status data!';
        return response()->json($msg, 200);
    }

    public function detail($id) {
        $id = Hashids::decode($id)[0];
        $qSurat = SuratKeluar::findOrFail($id);
        $accessDis = false;
        $terimaBtn = false;
        $disId = null;
        if(auth()->user()->level == 'user') {
            $opd = auth()->user()->opd()->first();
            foreach ($qSurat->opds as $o) {
                if(count($o->children) == 0) {
                    if($o->dis_tujuan == $opd->id_opd) {
                        $accessDis = true;
                        $o->dis_tgl_terima != null ? $terimaBtn = false : $terimaBtn = true;
                        $disId = $o->dis_id;
                    }
                } else {
//                    dd(Disposisis::where('dis_id', $o->dis_id)->leaves(), $o->dis_id);
                    $children = $o->where('dis_no_surat', $qSurat->no_surat)->leaves();
                    foreach ($children as $child) {
//                        dd($child);
                        if($child->dis_tujuan == $opd->id_opd) {
                            $accessDis = true;
                            $child->dis_tgl_terima != null ? $terimaBtn = false : $terimaBtn = true;
                            $disId = $child->dis_id;
                        }
                    }
                }
            }
            //Dikomentari karena ini menggunakan table tbl penerima qrcode
            /*if($opd->level_pj != env('OPD_BIASA')) {
                if (count($qSurat->disposisi) == 0) {
                    $accessDis = true;
                } else {
                    $loopCheck = true;
                    foreach ($qSurat->opd as $ops) {
                        if ($loopCheck) {
                            $disCheck = Disposisi::where('dis_no_surat', $qSurat->no_surat)->where('dis_asal', $ops->id_opd)->latest()->get();
//                       dd($disCheck, $ops);
                            $no = 0;
                            foreach ($disCheck as $dc) {
                                if ($no === 0) {
                                    if ($dc->dis_tujuan == $opd->id_opd) {
                                        $accessDis = true;
                                        $loopCheck = false;
                                    }
                                }
                                $no++;
                            }
                        }
                    }
                }

            } else {
                $loopCheck = true;
                foreach ($qSurat->opd as $ops) {
                    if ($loopCheck) {
                        $disCheck = Disposisi::where('dis_no_surat', $qSurat->no_surat)->where('dis_asal', $ops->id_opd)->latest()->get();
                        $no = 0;
                        foreach ($disCheck as $dc) {
                            if ($no === 0) {
                                if ($dc->dis_tujuan == $opd->id_opd) {
                                    $accessDis = true;
                                    $loopCheck = false;
                                }
                            }
                            $no++;
                        }
                    }
                }
            }*/
        }
        $data = [
            'title' => 'Detail Surat',
            'descTitle' => 'Detail Surat yang tersimpan pada '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Detail Surat', 'active' => true],
            ],
            'surat' => $qSurat,
            'gainedAccessDis' => $accessDis,
            'btnTerima' => $terimaBtn,
            'disID' => $disId
        ];

        return view('suratkeluar.detail', $data);
    }
}
