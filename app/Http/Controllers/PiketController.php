<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TahunService;
use Yajra\DataTables\Facades\DataTables;

class PiketController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $data_tahun = TahunService::getActive();
            $tahun = $data_tahun ? $data_tahun->alias_tahun:"Belum Tersedia";
            return view('piket.index', ['nama' => Auth::user()->name, 'tahun' => $tahun]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    public function listStudents(Request $request){
        if ($request->ajax()) {
            $data = Student::where('status','=','A')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="show" id="' . $row->id . '" class="show-detail btn btn-primary btn-sm">Detail</button>';
                    return $button;
                })
                ->make(true);
        }

        return view('piket.siswa');
    }
}
