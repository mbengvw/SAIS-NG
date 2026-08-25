<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChpassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $my_id = Auth::user()->id;
        $my_name = Auth::user()->name;
        $my_email = Auth::user()->email;
        return view('profile.index', ['id' => $my_id, 'name' => $my_name, 'email' => $my_email]);
    }

    public function change_pass(ChpassRequest $request)
    {
        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($request->input('old_pass'), $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password lama tidak cocok!'
            ], 400);
        }

        // Simpan password baru
        $user->password = Hash::make($request->input('new_pass'));
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah!'
        ]);
    }
}
