<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\OPD;
use App\Models\TandaTangan;
use App\Models\User;
use App\Services\AgendaService;
use App\Services\OPDService;
use App\Services\TandaTanganService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PDF;
use App;

class AgendaController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->agendaService = new AgendaService();
        $this->middleware('check.role:protokol');

    }

    public function getIndex() {
        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $user = Agenda::query();
            $fields = ['agenda_nama', 'agenda_pakaian'];

            if(request()->search != '') {
                foreach ($fields as $key => $value) {
                    if($key == 0)
                        $user->where($value, 'like', '%'. request()->search . '%');
                    else
                        $user->orWhere($value, 'like', '%'. request()->search . '%');

                }
            }
            if(request()->has('tanggal') && \request()->tanggal != null) {
                $user->whereDate('agenda_tgl_mulai','<=', \request()->tanggal)->where('agenda_tgl_akhir', '>=', \request()->tanggal);
            }

            $data['table'] = $user->latest()->paginate($page);
            return view('agenda._table_data', $data);
        }
        $data = [
            'title' => 'List Agenda',
            'descTitle' => 'Seluruh agenda di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Tanda Tangan Pimpinan', 'active' => true],
            ],
        ];

        return view('agenda.index', $data);
    }

    public function getCreate() {
        $data = [
            'title' => 'Tambah Agenda',
            'descTitle' => 'Halaman ini berfungsi untuk menambahkan agenda ke '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/agenda' , 'name' => 'Agenda'],
                ['url' => '#' , 'name' => 'Tambah Agenda', 'active' => true],
            ],
        ];
        return view('agenda.create', $data);
    }

    public function postIndex(Request $request) {
        $agendaRule = Agenda::$rules;
        $agendaAttr = Agenda::$attributeRule;
        $this->validate($request, $agendaRule, [], $agendaAttr);

        DB::beginTransaction();

        try {
            $this->agendaService->create($request->except(['_token']));
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, Agenda gagal dibuat!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Agenda berhasil dibuat!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function deleteIndex($id) {
        DB::beginTransaction();
        try {
            $this->agendaService->delete($id);
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
            'title' => 'Edit Agenda',
            'descTitle' => 'Halaman ini berfungsi untuk mengubah data agenda',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/agenda' , 'name' => 'Agenda'],
                ['url' => '#' , 'name' => 'Tambah Tanda Tangan', 'active' => true],
            ],
            'edit' => Agenda::find($id)
        ];
        return view('agenda.edit', $data);
    }

    public function putIndex($id, Request $request) {
        $tandaRule = Agenda::$rules;
        $tandaAttr = Agenda::$rules;

        $this->validate($request, $tandaRule, [], $tandaAttr);

        DB::beginTransaction();

        try {
            $this->agendaService->update($id, $request->except(['_token', '_method']));
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $th;
            $msg['success'] = false;
            $msg['message'] = 'Maaf, agenda gagal diubah!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();

        $msg['success'] = true;
        $msg['message'] = 'Agenda berhasil diubah!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }

    public function postBulkDelete() {
        DB::beginTransaction();
        try {
            $this->agendaService->deleteBulk(\request()->ids);
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


    public function getPrint()
    {
        $data = [
            'title' => 'Print Agenda',
            'descTitle' => 'Halaman ini berfungsi untuk mencetak data agenda',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/agenda' , 'name' => 'Agenda'],
                ['url' => '#' , 'name' => 'Print Agenda', 'active' => true],
            ],
            'users' => User::where('level', 'user')->get()
        ];
        return view('agenda.print', $data);
    }

    public function postPrint(Request $request)
    {

        $data['css'] = array('print/bootstrap.min.css');
        $data['tanggal'] = $request->agenda_tanggal;
        $data['agendas'] = Agenda::whereDate('agenda_tgl_mulai','<=', \request()->agenda_tanggal)->where('agenda_tgl_akhir', '>=', \request()->agenda_tanggal)->get();
        $data['tanda_tangan'] = App\Models\TandaTanganAgenda::first();
//        $data['user'] = User::find($request->agenda_ttd);

        $margins = explode(',', $request->margin);
//        return view('agenda.pdf', $data);
        if ($request->agenda_kertas == 'F4') {

            $pdf = PDF::loadView('agenda.pdf', $data)
                ->setOption('margin-top', $margins[0])
                ->setOption('margin-bottom', $margins[1])
                ->setOption('margin-left', $margins[2])
                ->setOption('margin-right', $margins[3])
                ->setOption('page-width', 210)
                ->setOption('page-height', 330)
                ->setOrientation('portrait');
        } else {
            $pdf = PDF::loadView('agenda.pdf', $data)
                ->setPaper($request->agenda_kertas)
                ->setOption('margin-top', $margins[0])
                ->setOption('margin-bottom', $margins[1])
                ->setOption('margin-left', $margins[2])
                ->setOption('margin-right', $margins[3])
                ->setOrientation('portrait');
        }
        if ($request->type == 'download') {
            return $pdf->download('Agenda Bupati Tuba Tanggal ' . Carbon::parse($request->agenda_tanggal)->isoFormat('D MMMM YYYY') . '.pdf');
        } else {
            return $pdf->inline('Agenda Bupati Tuba Tanggal ' . Carbon::parse($request->agenda_tanggal)->isoFormat('D MMMM YYYY') . '.pdf');
//            return response()->stream
        }
    }

    public function getTandaTangan()
    {
        $data = [
            'title' => 'Tanda Tangan Agenda',
            'descTitle' => 'Halaman ini berfungsi untuk menentukan nama penanda tangan agenda',
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '/agenda' , 'name' => 'Agenda'],
                ['url' => '#' , 'name' => 'Tanda Tangan Agenda', 'active' => true],
            ],
            'data' => App\Models\TandaTanganAgenda::first()
        ];
        return view('agenda.tanda-tangan', $data);
    }

    public function postTandaTangan(Request $request, $id = null)
    {
        DB::beginTransaction();
        try {
            if ($id == null) {
                App\Models\TandaTanganAgenda::create($request->all(['_token']));
            } else {
                App\Models\TandaTanganAgenda::where('id', $id)
                    ->update($request->except(['_token']));
            }
        } catch (QueryException $e) {
            DB::rollBack();
//            throw $e;
            $msg['success'] = false;
            $msg['message'] = 'Gagal mengubah tanda tangan agenda!';
            Session::flash('feedback', $msg);
            return redirect()->back();
        }

        DB::commit();
        $msg['success'] = true;
        $msg['message'] = 'Tanda Tangan Agenda berhasil diubah!';
        Session::flash('feedback', $msg);
        return redirect()->back();
    }
}
