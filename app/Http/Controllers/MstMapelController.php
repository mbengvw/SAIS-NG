<?php

namespace App\Http\Controllers;

use App\Models\MstMapel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MstMapelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MstMapel::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = ' <button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>
                                <button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-danger btn-sm">Hapus</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('master.mapel.index');
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $mapel = MstMapel::find($id);
        return response()->json($mapel);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = [
            'nama_mapel' => $request->nama_mapel,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->id) {
            MstMapel::where('id', $request->id)->update($data);
        } else {
            MstMapel::create($data);
        }

        return response()->json(['success' => 'Data tersimpan.']);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        MstMapel::where('id', $id)->delete();
        return response()->json(['success' => 'Data dihapus.']);
    }
}
