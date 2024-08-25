<?php

namespace App\Http\Controllers;

use App\Services\RekapPresensiService;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    public function index()
    {
        $tahun = TahunService::getActive()->alias_tahun;
        $nama = auth()->user()->name;
        // return view('walikelas', ['nama' => $nama, 'tahun' => $tahun]);
        return view('walikelas', ['nama' => $nama, 'tahun' => $tahun]);
    }

}
