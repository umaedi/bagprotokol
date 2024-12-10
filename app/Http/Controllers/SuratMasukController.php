<?php

namespace App\Http\Controllers;

use App\Models\SuratEksternal;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex() {

        if(\request()->ajax()) {
            $page = request()->get('paginate', 10);
            $data = [
            ];

            $opd = auth()->user()->opd()->first();

            if(\request()->type == 'internal') {
                $surat = SuratKeluar::query();
                //DIKOMENTARI DIKARENAKAN TIDAK MENGGUNAKAN TBL PENERIMA QRCODE
//                if(in_array($opd->level_pj, [env('OPD_ASISTEN', env('OPD_BIASA'))])) {
                    $surat->whereHas('disposisi', function ($q) use ($opd) {
                        $q->where('dis_tujuan', $opd->id_opd);
                    });
//                }
                $fields = ['no_surat'];
            } else {
                $surat = SuratEksternal::query();
//                if(in_array($opd->level_pj, [env('OPD_ASISTEN', env('OPD_BIASA'))])) {
                    $surat->whereHas('disposisi', function ($q) use ($opd) {
                        $q->where('dis_tujuan', $opd->id_opd);
                    });
//                }
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
            if(request()->status != '' && \request()->status != 'all') {
                $surat->where('status', \request()->status);
            }


            $data['table'] = $surat->latest()->paginate($page);
            if(\request()->type == 'internal') {
                return view('suratmasuk._table_data_internal', $data);
            } else {
                return view('suratmasuk._table_data_eksternal', $data);
            }
        }

        $data = [
            'title' => 'List Surat Masuk',
            'descTitle' => 'Seluruh surat masuk di aplikasi '. env('APP_NAME'),
            'breadcrumb' => [
                ['url' => '/' , 'name' => 'Home'],
                ['url' => '#' , 'name' => 'Surat Masuk', 'active' => true],
            ],
        ];

        return view('suratmasuk.index', $data);
    }
}
