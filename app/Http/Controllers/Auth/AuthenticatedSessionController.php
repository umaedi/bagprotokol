<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $data = [
            'title' => 'Pilih Aplikasi'
        ];
        return view('auth.login', $data);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        saveLogs('login sistem', 'aktivitas');
        $level = Auth::user()->level;

        if (url()->previous() == url('/login-seruit') && in_array($level, [env('ROLE_SURAT'), env('ROLE_USER')])) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else if (url()->previous() == url('/login-dokumentasi') && $level == env('ROLE_DOKUMENTASI')) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else if (url()->previous() == url('/login-agenda') && $level == env('ROLE_PROTOKOL')) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else if ($level == env('ROLE_ADMIN') || $level == env('ROLE_SUPERADMIN')) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            Auth::logout();
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect()->back()->withErrors(['username' => 'Akun anda tidak dapat masuk ke aplikasi ini']);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Cache::forget('user_' . auth()->id());
        saveLogs('logout sistem', 'aktivitas');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
