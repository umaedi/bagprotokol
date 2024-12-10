<?php

namespace App\Providers;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        /*View::composer(
            'profile', 'App\Http\View\Composers\ProfileComposer'
        );*/

        // Using Closure based composers...
        View::composer('fronts.layout.breaking-news', function ($view) {
            $data = Galeri::limit(5)->latest()->get();
            $view->with('cacheBreaking', $data);
        });
        View::composer('fronts.layout.kategori', function ($view) {
            $data = KategoriGaleri::active()->withCount('galeri')->get();
            $view->with('cacheKategori', $data);
        });

        View::composer('*', function ($view) {
            $data = null;

            if(auth()->check()) {

                $user = auth()->user();
                if(!Cache::has('user_'.$user->id) || env('APP_DEBUG')) {

                    Cache::put('user_'.$user->id, $user, 3600);
                    $view->with('user', $user);

                } else {
                    $user = Cache::get('user_'.$user->id);
                    $view->with('user', $user);
                }
            }

            if (!Cache::has('settings') || env('APP_DEBUG')) {

                $setting = Settings::all();
                foreach ($setting as $s) {
                    $data[$s->setting_var] = $s->setting_val;
                }

                Cache::put('settings', $data, 3600);

                $view->with('settings', $data);
            } else {

                $data = Cache::get('settings');
                $view->with('settings', $data);

            }
        });

        View::composer('front.layouts._right_sidebar', function ($view) {
            $data = KategoriGaleri::active()->withCount('galeri')->get();
            $view->with('categori', $data);
        });
    }
}
