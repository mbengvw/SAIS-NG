<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmisController extends Controller
{
    public function rekap(){
        return view('publik.rekap_siswa');
    }
}
