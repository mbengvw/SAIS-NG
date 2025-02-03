<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\SiswaService;
use Exception;
use Illuminate\Http\Request;

class ApiSiswaController extends Controller
{
    private SiswaService $siswaService;

    public function __construct(SiswaService $siswaService)
    {
        $this->siswaService = $siswaService;
    }
    
    public function showByNisn(Request $request)
    {
        try{
            $siswa=$this->siswaService->showByNisn($request->nisn);
            return response()->json(['status' => 'success','message' => 'OK','data' => $siswa], 200);
        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'message' => $e->getMessage(), 'data' => null], 401);
        }
    }

    public function showByNis(Request $request)
    {
        try {
            $siswa = $this->siswaService->showByNis($request->nis);
            return response()->json(['status' => 'success', 'message' => 'OK', 'data' => $siswa], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage(), 'data' => null], 401);
        }
    }

    public function listByTahun(Request $request)
    {
        // dd($request->tahun);
        $data=$this->siswaService->listByAngkatan($request->tahun);
        return response()->json(['status' => 'success', 'message' => 'OK', 'data' => $data], 200);
    }
}
