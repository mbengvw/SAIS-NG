<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Services\TahunService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TahunAkademikController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tahun::all();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="set" id="' . $row->id . '" class="set btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Set Aktif</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('tahun.index');
    }

    public function add()
    {
        $new_data = TahunService::addNew();
        Tahun::create($new_data);
    }

    public function setActive(Request $request)
    {
        $id = $request->id;
        TahunService::setActive($id);
    }
}
