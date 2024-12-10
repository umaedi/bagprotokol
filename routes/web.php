<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//SHORTCUT UNTUK MEMBUAT STORAGE LINK PADA SHARED HOSTING
/*Route::get('sysmlink', function(){
    $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/sourceCode/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($targetFolder, $linkFolder);
    return 'success';
});*/

Route::get('/', [HomeController::class, 'beranda']);
Route::get('/post', [HomeController::class, 'search']);
Route::get('/login-seruit', [HomeController::class, 'loginSeruit'])->middleware('guest');
Route::get('/login-agenda', [HomeController::class, 'loginAgenda'])->middleware('guest');
Route::get('/login-dokumentasi', [HomeController::class, 'loginDok'])->middleware('guest');
Route::get('/post/kategori/{topik}', [HomeController::class, 'topik']);
Route::get('/post/{seo}', [HomeController::class, 'detail']);
Route::get('/dashboard',[HomeController::class, 'dashboard'])->middleware('auth');
Route::get('/offline', [HomeController::class, 'offline']);

\AdvancedRoute::controllers([
    'setting' => SettingsController::class,
    'profile' => ProfileController::class,
    'users' => UserController::class,
    'opd' => OPDController::class,
    'galeri' => GaleriController::class,
    'agenda' => AgendaController::class,
    'youtube' => YoutubeController::class,
]);

Route::post('/galeri/kategori/bulk-delete', [GaleriController::class, 'bulkDeleteCategori']);
Route::post('/galeri/kategori/bulk-status', [GaleriController::class, 'bulkStatusCategori']);
Route::get('/galeri/kategori/create', [GaleriController::class, 'createCategori']);
Route::post('/galeri/kategori', [GaleriController::class, 'insertCategori']);
Route::put('/galeri/kategori/{id}', [GaleriController::class, 'putCategori']);
Route::get('/galeri/kategori/edit/{id}', [GaleriController::class, 'editCategori']);
Route::delete('/galeri/kategori/{id}', [GaleriController::class, 'deleteCategori']);

Route::prefix('surat')->group(function () {
    \AdvancedRoute::controllers([
        'tanda-tangan' => TandaTanganController::class,
        'eksternal' => SuratEksternalController::class,
        'keluar' => SuratKeluarController::class,
        'masuk' => SuratMasukController::class,
        'disposisi' => DisposisiController::class,
    ]);

    Route::get('detail/{id}', [SuratKeluarController::class, 'detail']);
    Route::get('disposisi/{id}/surat/{disID?}', [DisposisiController::class, 'detailInternalDis']);
    Route::get('disposisi/{id}/eksternal/{disID?}', [DisposisiController::class, 'detailEksternalDis']);
});

Route::get('/master', function () {
    $data = [
        'title' => 'Contoh Interface',
        'descTitle' => 'Ini adalah halaman contoh dari interface aplikasi',
        'breadcrumb' => [
            ['url' => '/' , 'name' => 'Home'],
            ['url' => '/interface' , 'name' => 'Interface'],
            ['url' => '/master' , 'name' => 'Master', 'active' => true],
        ]
    ];
    return view('example', $data);
});
require __DIR__ . '/auth.php';
