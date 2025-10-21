<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; // <-- ini wajib ditambah

class ProfileController extends Controller
{
    public function index()
{
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

      $user->name = $request->name;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();


    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}
}