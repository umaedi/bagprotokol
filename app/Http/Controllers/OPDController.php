<?php

namespace App\Http\Controllers;

use App\Models\OPD;
use App\Models\User;
use App\Services\OPDService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OPDController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->opdService = new OPDService();
        $this->middleware('check.role:superadmin,admin');

    }

    public function getIndex() {
        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $user = OPD::query();
            $fields = ['nama_opd', 'alias_opd', 'email_opd', 'notelepon_opd'];

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
            return view('opd._table_data', $data);
        }
        $data = [
            'title' => 'List Organisasi Perangkat Daerah',
            'descTitle' => 'Seluruh organisasi perangkat daerah di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/opd' , 'name' => 'Organisasi Perangkat Daerah', 'active' => true],
            ],
        ];

        return view('opd.index', $data);
    }

    public function getCreate() {
        $data = [
            'title' => 'Tambah Organisasi Perangkat Daerah',
            'descTitle' => 'Halaman ini berfungsi untuk menambahkan opd ke '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/opd' , 'name' => 'OPD'],
                ['url' => '/users/create' , 'name' => 'Tambah OPD', 'active' => true],
            ],
            'users' => User::where('level', 'pengguna')->doesnthave('opd')->get(['id', 'name']),
        ];
        return view('opd.create', $data);
    }

    public function postIndex(Request $request) {
        $userRules = OPD::$rules;
        $this->validate($request, $userRules, []);

        DB::beginTransaction();

        try {
            $this->opdService->create($request->except(['_token']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, opd gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Organisasi perangkat daerah berhasil dibuat!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function deleteIndex($id) {
        DB::beginTransaction();
        try {
            $this->opdService->delete($id);
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
            'title' => 'Edit OPD',
            'descTitle' => 'Halaman ini berfungsi untuk mengubah data opd',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/opd' , 'name' => 'OPD'],
                ['url' => '#' , 'name' => 'Edit OPD', 'active' => true],
            ],
            'pengguna' => User::where('level', 'pengguna')->doesnthave('opd')->get(['id', 'name']),
            'edit' => OPD::find($id)
        ];
        return view('opd.edit', $data);
    }

    public function putIndex($id, Request $request) {
        $opdRule = OPD::$rules;

        $this->validate($request, $opdRule, []);

        DB::beginTransaction();

        try {
            $this->opdService->update($id, $request->except(['_token', '_method']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, opd gagal diubah!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'OPD berhasil diubah!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function postBulkDelete() {
        DB::beginTransaction();
        try {
            $this->opdService->deleteBulk(\request()->ids);
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
            $this->opdService->statusBulk(request()->status, \request()->ids);
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
