<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TahunService;
use Illuminate\Support\Facades\Auth;

class GuruMapelController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (!Auth::user()->hasRole('guru-mapel')) {
                return redirect('/guess')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            $data_tahun = TahunService::getActive();
            $tahun = $data_tahun ? $data_tahun->alias_tahun : "Belum Tersedia";
            
            return view('gurumapel.index', [
                'nama' => Auth::user()->name, 
                'tahun' => $tahun,
                'data_tahun' => $data_tahun
            ]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }
}
