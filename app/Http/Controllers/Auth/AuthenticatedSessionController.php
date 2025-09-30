<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi login
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect otomatis sesuai role
        if ($request->user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        // User biasa
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Proses logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();           // Logout user/admin
        $request->session()->invalidate();       // Hapus session
        $request->session()->regenerateToken();  // Regenerate CSRF token

        // Setelah logout, semua diarahkan ke landing
        return redirect()->route('landing');
    }
}
