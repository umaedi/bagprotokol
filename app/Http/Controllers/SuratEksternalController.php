<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\OPD;
use App\Models\SuratEksternal;
use App\Models\TandaTangan;
use App\Models\User;
use App\Services\OPDService;
use App\Services\SuratEksternalService;
use App\Services\TandaTanganService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Vinkla\Hashids\Facades\Hashids;

class SuratEksternalController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.role:surat,user');
        $this->suratEksternalService = new SuratEksternalService();
    }

    public function getIndex() {
        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $surat = SuratEksternal::query();
            if (auth()->user()->level == env('role_surat'))
                $surat->where('eks_created_by', auth()->id());

            $fields = ['eks_nosurat', 'eks_dari', 'eks_pengirim', 'eks_tertanda', 'eks_teruskan', 'eks_perihal'];

            if(request()->search != '') {
                foreach ($fields as $key => $value) {
                    if($key == 0)
                        $surat->where($value, 'like', '%'. request()->search . '%');
                    else
                        $surat->orWhere($value, 'like', '%'. request()->search . '%');

                }
            }
            if(request()->status != '' && \request()->status != 'all') {
                $surat->where('eks_status', \request()->status);
            }

            $data['table'] = $surat->latest()->paginate($page);
            return view('surateksternal._table_data', $data);
        }
        $data = [
            'title' => 'List Surat Eksternal',
            'descTitle' => 'Seluruh surat eksternal yang terdaftar di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Surat Eksternal', 'active' => true],
            ],
        ];

        return view('surateksternal.index', $data);
    }

    public function getCreate() {
        $data = [
            'title' => 'Tambah Surat Eksternal',
            'descTitle' => 'Halaman ini berfungsi untuk menambahkan surat eksternal ke '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/surat/eksternal' , 'name' => 'Surat Eksternal'],
                ['url' => '#' , 'name' => 'Tambah Surat Eksternal', 'active' => true],
            ],
            'opd' => OPD::where('active', '1')->get(),
        ];
        return view('surateksternal.create', $data);
    }

    public function postIndex(Request $request) {
        $suratRule = SuratEksternal::$rules;
        $suratAttr = SuratEksternal::$attributeRule;
        if($request->has('eks_status') && $request->input('eks_status') == 'Disposisi') {
            $suratRule['tujuan.*'] = 'required';
//            $suratRule['dis_tgl'] = 'required';
//            $suratRule['dis_catatan'] = 'required';
            $suratAttr['tujuan.*'] = 'Tujuan Disposisi';
            $suratAttr['dis_tgl'] = 'Tanggal Disposisi';
            $suratAttr['dis_catatan'] = 'Catatan Disposisi';
        }
        $this->validate($request, $suratRule, [], $suratAttr);

        DB::beginTransaction();

        try {
            $this->suratEksternalService->create($request->except(['_token']));
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Surat Eksternal gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Surat Eksternal berhasil dibuat!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function getDetail($id)
    {
        $id = Hashids::decode($id)[0];
        $qSurat = SuratEksternal::findOrFail($id);
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
                    $children = $o->where('dis_no_surat', $qSurat->eks_nosurat)->leaves();
//                    dd($o, $children);
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
        } else {
            $accessDis = true;
        }

        $data = [
            'title' => 'Detail Surat Eksternal',
            'descTitle' => 'Detail Surat Eksternal yang tersimpan pada '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Detail Surat', 'active' => true],
            ],
            'surat' => $qSurat,
            'gainedAccessDis' => $accessDis,
            'btnTerima' => $terimaBtn,
            'disID' => $disId
        ];

        return view('surateksternal.detail', $data);

        /*$qSurat = SuratEksternal::find($id);
        $accessDis = false;
        if (auth()->user()->level == 'user') {
            $opd = auth()->user()->opd()->first();

            if (in_array($opd->id_opd, $qSurat->opd->pluck('id_opd')->toArray())) {
                $accessDis = true;
                $disCheck = Disposisi::where('dis_no_surat', $qSurat->eks_nosurat)->where('dis_asal', $opd->id_opd)->latest()->first();
                if ($disCheck) {
                    $accessDis = $disCheck->dis_tujuan == $opd->id_opd;
                }

            } else {
                $loopCheck = true;
                foreach ($qSurat->opd as $ops) {
                    if ($loopCheck) {
                        $disCheck = Disposisi::where('dis_no_surat', $qSurat->eks_nosurat)->where('dis_asal', $ops->id_opd)->latest()->get();
//                        dd($disCheck, $ops);
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
        }

        $data = [
            'title' => 'Detail Surat Eksternal',
            'descTitle' => 'Detail Surat Eksternal yang tersimpan pada '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Detail Surat', 'active' => true],
            ],
            'surat' => $qSurat,
            'gainedAccessDis' => $accessDis
        ];

        return view('surateksternal.detail', $data);*/
    }

    public function deleteIndex($id) {
        DB::beginTransaction();
        try {
            $this->suratEksternalService->delete($id);
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
            'title' => 'Edit Surat Eksternal',
            'descTitle' => 'Halaman ini berfungsi untuk mengubah data surat eksternal',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/surat/eksternal' , 'name' => 'Surat Eksternal'],
                ['url' => '#' , 'name' => 'Edit Surat Eksternal', 'active' => true],
            ],
            'edit' => SuratEksternal::find($id),
            'opd' => OPD::where('active', '1')->get(),
        ];
        return view('surateksternal.edit', $data);
    }

    public function putIndex($id, Request $request) {
        $suratRule = SuratEksternal::$rules;
        $suratRule['eks_file_lampiran'] = 'mimes:pdf';
        $suratAttr = SuratEksternal::$attributeRule;
        $this->validate($request, $suratRule, [], $suratAttr);

        DB::beginTransaction();

        try {
            $this->suratEksternalService->update($id, $request->except(['_token', '_method']));
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
            $this->suratEksternalService->deleteBulk(\request()->ids);
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
}
