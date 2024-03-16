<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TahunService;

class PiketController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $tahun = TahunService::getActive()->alias_tahun;
            return view('piket.index', ['nama' => Auth::user()->name, 'tahun' => $tahun]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }
}
