<?php

namespace App\Http\Controllers;

use App\Models\OPD;
use App\Models\TandaTangan;
use App\Models\User;
use App\Services\OPDService;
use App\Services\TandaTanganService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TandaTanganController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.role:surat');
        $this->ttdService = new TandaTanganService();
    }

    public function getIndex() {
        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $user = TandaTangan::query();
            $fields = ['jenis_ttd'];

            if(request()->search != '') {
                foreach ($fields as $key => $value) {
                    if($key == 0)
                        $user->where($value, 'like', '%'. request()->search . '%');
                    else
                        $user->orWhere($value, 'like', '%'. request()->search . '%');

                }
            }
            if(request()->status != '' && \request()->status != 'all') {
                $user->where('active', \request()->status);
            }

            $data['table'] = $user->latest()->paginate($page);
            return view('tandatangan._table_data', $data);
        }
        $data = [
            'title' => 'List Tanda Tangan Pimpinan',
            'descTitle' => 'Seluruh tanda tangan pimpinan di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Tanda Tangan Pimpinan', 'active' => true],
            ],
        ];

        return view('tandatangan.index', $data);
    }

    public function getCreate() {
        $data = [
            'title' => 'Tambah Tanda Tangan Pimpinan',
            'descTitle' => 'Halaman ini berfungsi untuk menambahkan tanda tangan ke '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/surat/tanda-tangan' , 'name' => 'Tanda Tangan Pimpinan'],
                ['url' => '#' , 'name' => 'Tambah Tanda Tangan Pimpinan', 'active' => true],
            ],
        ];
        return view('tandatangan.create', $data);
    }

    public function postIndex(Request $request) {
        $tandaRule = TandaTangan::$rules;
        $tandaAttr = TandaTangan::$attributeRule;
        $this->validate($request, $tandaRule, [], $tandaAttr);

        DB::beginTransaction();

        try {
            $this->ttdService->create($request->except(['_token']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Tanda tangan gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Tanda Tangan Pimpinan berhasil dibuat!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function deleteIndex($id) {
        DB::beginTransaction();
        try {
            $this->ttdService->delete($id);
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
            'title' => 'Edit Tanda Tangan Pimpinan',
            'descTitle' => 'Halaman ini berfungsi untuk mengubah data tanda tangan',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/surat/tanda-tangan' , 'name' => 'Tanda Tangan Pimpinan'],
                ['url' => '#' , 'name' => 'Edit Tanda Tangan', 'active' => true],
            ],
            'edit' => TandaTangan::find($id)
        ];
        return view('tandatangan.edit', $data);
    }

    public function putIndex($id, Request $request) {
        $tandaRule = TandaTangan::$rules;
        $tandaAttr = TandaTangan::$rules;

        $this->validate($request, $tandaRule, [], $tandaAttr);

        DB::beginTransaction();

        try {
            $this->ttdService->update($id, $request->except(['_token', '_method']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, tanda tangan gagal diubah!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Tanda tangan berhasil diubah!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function postBulkDelete() {
        DB::beginTransaction();
        try {
            $this->ttdService->deleteBulk(\request()->ids);
        } catch (QueryException $e) {
            DB::rollBack();
            $msg['success'] = false;
            $msg['message'] = 'Maaf, terjadi kegagalan dalam menghapus data!';
            return response()->json($msg, 200);
        }

        DB::commit();
        $msg['success'] = true;
        $msg['message'] = 'Berhasil menghapus data!';
        return response()->json($msg, 200);
    }

    public function postBulkStatus() {
        DB::beginTransaction();
        try {
            $this->ttdService->statusBulk(request()->status, \request()->ids);
        } catch (QueryException $e) {
            DB::rollBack();
            $msg['success'] = false;
            $msg['message'] = 'Maaf, terjadi kegagalan dalam mengganti status data!';
            return response()->json($msg, 200);
        }

        DB::commit();
        $msg['success'] = true;
        $msg['message'] = 'Berhasil mengganti status data!';
        return response()->json($msg, 200);
    }
}
