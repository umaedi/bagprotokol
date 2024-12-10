<?php

namespace App\Http\Controllers;

use App\Models\KategoriGaleri;
use App\Models\OPD;
use App\Models\TandaTangan;
use App\Models\User;
use App\Models\Youtube;
use App\Services\OPDService;
use App\Services\TandaTanganService;
use App\Services\YoutubeService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class YoutubeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.role:dokumentasi');
        $this->ytService = new YoutubeService();
    }

    public function getIndex() {
        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);

            $user = Youtube::query();
            $fields = ['title', 'url'];

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
            return view('youtube._table_data', $data);
        }
        $data = [
            'title' => 'List Youtube',
            'descTitle' => 'Seluruh youtube di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Youtube', 'active' => true],
            ],
        ];

        return view('youtube.index', $data);
    }

    public function getCreate() {
        $data = [
            'title' => 'Tambah Youtube',
            'descTitle' => 'Halaman ini berfungsi untuk menambahkan youtube ke '. env('APP_NAME'),
            'kategori' => KategoriGaleri::active()->get(),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/youtube' , 'name' => 'Youtube'],
                ['url' => '#' , 'name' => 'Tambah Youtube', 'active' => true],
            ],
        ];
        return view('youtube.create', $data);
    }

    public function postIndex(Request $request) {
        $tandaRule = Youtube::$rules;
        $this->validate($request, $tandaRule, []);

        DB::beginTransaction();

        try {
            $this->ytService->create($request->except(['_token']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Youtube gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Youtube berhasil dibuat!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function deleteIndex($id) {
        DB::beginTransaction();
        try {
            $this->ytService->delete($id);
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
            'title' => 'Edit Youtube',
            'descTitle' => 'Halaman ini berfungsi untuk mengubah data youtube',
            'kategori' => KategoriGaleri::active()->get(),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/youtube' , 'name' => 'Youtube'],
                ['url' => '#' , 'name' => 'Edit Youtube', 'active' => true],
            ],
            'edit' => Youtube::find($id)
        ];
        return view('youtube.edit', $data);
    }

    public function putIndex($id, Request $request) {
        $tandaRule = Youtube::$rules;
        $tandaAttr = Youtube::$rules;

        $this->validate($request, $tandaRule, [], $tandaAttr);

        DB::beginTransaction();

        try {
            $this->ytService->update($id, $request->except(['_token', '_method']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, youtube gagal diubah!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Youtube berhasil diubah!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function postBulkDelete() {
        DB::beginTransaction();
        try {
            $this->ytService->deleteBulk(\request()->ids);
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
            $this->ytService->statusBulk(request()->status, \request()->ids);
        } catch (QueryException $e) {
//            throw $e;
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
