<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- ini wajib ditambah

class ProfileController extends Controller
{
    public function index()
{
    // login dummy pakai user id 1
    Auth::loginUsingId(3);

    $user = Auth::user(); // ini Eloquent, created_at pasti Carbon

    return view('user.profile.index', compact('user'));
}

public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'gender' => 'required|in:pria,wanita',
        'email' => 'required|email|max:255',
        'phone_number' => 'nullable|string|max:20',
    ]);

    $user->update([
        'name' => $request->name,
        'username' => $request->username,
        'gender' => $request->gender,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
    ]);

    return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
}
}