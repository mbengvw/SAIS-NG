<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewKelasRequest;
use App\Models\Kelas;
use App\Services\KelasService;
use App\Services\TahunService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
{
    private KelasService $kelasService;

    public function __construct(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }

    public function index(Request $request)
    {
        $tahun = TahunService::getActive()->tahun;
        if ($request->ajax()) {
            $data = Kelas::where('tahun', '=', $tahun)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = ' <button type="button" name="edit" id="' . $row->id_kelas . '" class="edit btn btn-primary btn-sm">Edit</button>
                                <button type="button" name="delete" id="' . $row->id_kelas . '" class="delete btn btn-primary btn-sm">Hapus</button>';

                    return $button;
                })
                ->make(true);
        }
        return view(
            'kelas.index',
            [
                'id_tahun' => TahunService::getActive()->id,
                'tahun' => TahunService::getActive()->tahun,
                'semester' => TahunService::getActive()->semester
            ]
        );
    }

    public function show(Request $request)
    {
        $id_kelas = $request->id;
        return ($this->kelasService->show($id_kelas));
    }

    public function add(NewKelasRequest $request)
    {
        $new_data = $request->all();
        return ($this->kelasService->create($new_data));
    }

    public function destroy(Request $request)
    {
        $id_kelas = $request->id;
        return ($this->kelasService->destroy($id_kelas));
    }
}
