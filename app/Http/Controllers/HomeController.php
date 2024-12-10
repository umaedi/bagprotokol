<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\KategoriGaleri;
use App\Models\SuratEksternal;
use App\Models\SuratKeluar;
use App\Models\Youtube;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'descTitle' => 'Overview singkat dari aplikasi',
            'breadcrumb' => [
                ['url' => '/', 'name' => env('APP_NAME')],
                ['url' => '/', 'name' => 'Dashboard', 'active' => true],
            ],
            'suratkeluar_count' => SuratKeluar::count(),
            'suratmasuk_count' => SuratEksternal::count(),
            'suratkeluar_today_count' => SuratKeluar::whereDate('tgl_surat', now())->count(),
            'suratmasuk_today_count' => SuratEksternal::whereDate('eks_tgl_surat', now())->count(),
            'agenda_count' => Agenda::count(),
            'agendatoday_count' => Agenda::whereDate('agenda_tgl_mulai', now())->count(),
            'foto_count' => Galeri::count(),
            'fototoday_count' => Galeri::whereDate('tanggal', now())->count(),
        ];
        if (in_array(auth()->user()->level, [env('ROLE_PROTOKOL'), env('ROLE_SUPERADMIN')])) {
            $data['agenda'] = Agenda::whereBetween('agenda_tgl_mulai', [now(), now()->addDays(8)])->orderBy('agenda_tgl_mulai', 'desc')->paginate(10);
        }

        return view('dashboard', $data);
    }

    public function beranda()
    {
        if (request()->ajax()) {
            if (\request()->has('cat')) {
                $cat = \request()->cat;
                $page = \request()->page * 6;
                $data['page'] = \request()->page + 1;
                if ($cat == 'yt') {
                    $posts = Youtube::active()->skip($page)->latest()->take(6)->get();
                    $data['view_tab'] = view('fronts.layout._column_yt_tab', ['posts' => $posts])->render();
                    $data['view_content'] = view('fronts.layout._column_yt_content', ['posts' => $posts])->render();
                    return response()->json($data, 200);
                }

                $post = Galeri::active()->whereHas('kategori', function (Builder $builder) use ($cat) {
                    $builder->where('label', $cat);
                })->skip($page)->latest()->take(6)->get();

                $data['view'] = view('fronts.layout._column_post', ['post' => $post])->render();

                return response()->json($data, 200);
            }
        }
        $data = [
            'title' => 'Beranda',
            'recent_foto' => Galeri::active()->latest()->limit(4)->get(),
            'randPost' => Galeri::active()->inRandomOrder()->limit(4)->get(),
            'kategori' => KategoriGaleri::active()->with('galeri', function ($q) {
                $q->limit(7)->latest();
            })->latest()->has('galeri')->get(),
            'yts' => Youtube::active()->limit(7)->latest()->get(),
        ];


        return view('fronts.index', $data);
    }

    public function detail($seo)
    {
        $post = Galeri::where('seotitle', $seo)->firstOrFail();

        $previous = Galeri::find(Galeri::where('id', '<', $post->id)->max('id'));
        $next = Galeri::find(Galeri::where('id', '>', $post->id)->min('id'));

        $data = [
            'title' => $post->title,
            'post' => $post,
            'prev_post' => $previous,
            'next_post' => $next,
            'recentPost' => Galeri::active()->latest()->limit(5)->get(),
            'randKonten' => Galeri::active()->inRandomOrder()->limit(5)->get(),
        ];

        return view('fronts.detail', $data);
    }

    public function search()
    {
        $data = [
            'title' => 'Hasil pencarian: ' . \request()->search,
            'recentPost' => Galeri::active()->latest()->limit(4)->get(),
            'randKonten' => Galeri::active()->inRandomOrder()->limit(5)->get(),
            'posts' => Galeri::where('title', 'like', '%' . \request()->search . '%')->latest()->paginate(10)
        ];

        return view('fronts.search', $data);
    }
    public function topik($topik)
    {
        $data = [
            'title' => 'Topik : ' . $topik,
            'randKonten' => Galeri::active()->inRandomOrder()->limit(5)->get(),
            'recentPost' => Galeri::active()->latest()->limit(4)->get(),
            'posts' => Galeri::whereHas('kategori', function ($q) use ($topik) {
                $q->where('label', $topik);
            })->latest()->paginate(10),
            'topik' => $topik
        ];
        return view('fronts.topik', $data);
    }

    public function loginSeruit()
    {
        return view('auth.login-seruit');
    }

    public function loginAgenda()
    {
        return view('auth.login-agenda');
    }
    public function loginDok()
    {
        return view('auth.login-dokumentasi');
    }

    public function offline()
    {
        return view('offline');
    }
}
