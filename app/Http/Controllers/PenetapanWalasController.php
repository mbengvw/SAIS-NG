<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Walikelas;
use App\Services\SetWalikelasService;
use App\Services\TahunService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenetapanWalasController extends Controller
{
    private SetWalikelasService $walikelasService;

    public function __construct(SetWalikelasService $walikelasService)
    {
        $this->walikelasService = $walikelasService;
    }

    public function index()
    {
        $tahun = TahunService::getActive();
        $list_guru = User::orderBy('name', 'ASC')->get();
        $list_kelas = Kelas::where('tahun','=',$tahun->tahun)->orderBy('tingkat', 'ASC')->get();
        return view('walas.penetapan',          [
            'id_tahun' => TahunService::getActive()->id,
            'tahun' => TahunService::getActive()->tahun,
            'semester' => TahunService::getActive()->semester,
            'list_guru' => $list_guru,
            'list_kelas' => $list_kelas,
        ]);
    }

    public function listAll(Request $request)
    {
        $tahun = TahunService::getActive()->tahun;
        if ($request->ajax()) {
            $data = $this->walikelasService->listWalikelas($tahun);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = ' <button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-primary btn-sm">Hapus</button>';

                    return $button;
                })
                ->make(true);
        }
    }

    public function create(Request $request) 
    {
        $new_data = $request->all();
        return $this->walikelasService->create($new_data);
    }

    public function destroy(Request $request)
    {
        $id_walas = $request->id;
        return ($this->walikelasService->destroy($id_walas));
    }
}
