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
        $id = $request->input('id');
        $new_pass = $request->input('new_pass');

        $user = User::find($id);

        if ($user) {
            $new_hash = Hash::make($new_pass);
            $user->password = $new_hash;
            $user->save();
            return response()->json(['message' => 'Password berhasil dirubah !']);
        }
    }
}
