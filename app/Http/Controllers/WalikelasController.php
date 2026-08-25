<?php

namespace App\Http\Controllers;

use App\Services\RekapPresensiService;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    public function index(\App\Services\WalikelasDashboardService $dashboardService)
    {
        $data_tahun = TahunService::getActive();
        $tahun_name = $data_tahun->alias_tahun;
        $tahun_id = $data_tahun->id;
        $semester = $data_tahun->semester;
        $user_id = auth()->user()->id;
        $nama = auth()->user()->name;

        // Ensure user is walikelas
        if (!WalikelasService::isWalikelas($user_id, $tahun_id)) {
            return redirect('/')->with('error', 'Anda bukan wali kelas tahun ini.');
        }

        $id_kelas = WalikelasService::getIdKelas($user_id, $tahun_id);
        
        $metrics = $dashboardService->getDashboardMetrics($id_kelas, $tahun_id, $tahun_name, $semester);

        return view('walikelas', [
            'nama' => $nama, 
            'tahun' => $tahun_name,
            'metrics' => $metrics
        ]);
    }

}
