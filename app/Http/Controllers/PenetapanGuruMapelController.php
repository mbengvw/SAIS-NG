<?php

namespace App\Http\Controllers;

use App\Models\PenetapanGuruMapel;
use App\Models\MstMapel;
use App\Models\Kelas;
use App\Models\User;
use App\Services\TahunService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenetapanGuruMapelController extends Controller
{
    public function index(Request $request)
    {
        $tahun = TahunService::getActive();
        if ($request->ajax()) {
            $data = PenetapanGuruMapel::with(['kelas', 'mapel', 'guru', 'tahun'])
                ->where('id_tahun', $tahun->id)
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = ' <button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>
                                <button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-danger btn-sm">Hapus</button>';
                    return $button;
                })
                ->make(true);
        }

        $mapel = MstMapel::all();
        $kelas = Kelas::where('id_tahun', $tahun->id)->get();
        // Assuming role 'guru' or 'admin' or just fetch users 
        // For simplicity, fetch users not admin and not siswa
        $guru = User::whereDoesntHave('roles', function ($q) {
            $q->whereIn('name', ['siswa']);
        })->get();

        return view('master.penetapan_guru_mapel.index', compact('mapel', 'kelas', 'guru'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $penetapan = PenetapanGuruMapel::find($id);
        return response()->json($penetapan);
    }

    public function getKelas(Request $request)
    {
        $mapel = MstMapel::find($request->id_mapel);
        $tahun = TahunService::getActive();

        $query = Kelas::where('id_tahun', $tahun->id);

        if ($mapel && $mapel->tingkat) {
            $query->where('tingkat', $mapel->tingkat);
        }
        if ($mapel && $mapel->jurusan && strtolower($mapel->jurusan) != 'umum') {
            $query->where('jurusan', $mapel->jurusan);
        }

        // Exclude classes that are already assigned to this mapel in the current academic year
        $assignedKelasIds = PenetapanGuruMapel::where('id_mapel', $request->id_mapel)
            ->where('id_tahun', $tahun->id)
            ->pluck('id_kelas');

        $query->whereNotIn('id_kelas', $assignedKelasIds);

        $kelas = $query->get();
        return response()->json($kelas);
    }

    public function add(Request $request)
    {
        if ($request->id) {
            $validator = Validator::make($request->all(), [
                'id_kelas' => 'required',
                'id_mapel' => 'required',
                'id_guru' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'id_kelas' => 'required|array',
                'id_mapel' => 'required',
                'id_guru' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $tahun = TahunService::getActive();

        if ($request->id) {
            $id_kelas = is_array($request->id_kelas) ? $request->id_kelas[0] : $request->id_kelas;
            $data = [
                'id_tahun' => $tahun->id,
                'id_kelas' => $id_kelas,
                'id_mapel' => $request->id_mapel,
                'id_guru' => $request->id_guru,
            ];
            PenetapanGuruMapel::where('id', $request->id)->update($data);
        } else {
            foreach ($request->id_kelas as $kelas_id) {
                $exists = PenetapanGuruMapel::where('id_tahun', $tahun->id)
                    ->where('id_kelas', $kelas_id)
                    ->where('id_mapel', $request->id_mapel)
                    ->first();
                if ($exists) {
                    $exists->update(['id_guru' => $request->id_guru]);
                } else {
                    PenetapanGuruMapel::create([
                        'id_tahun' => $tahun->id,
                        'id_kelas' => $kelas_id,
                        'id_mapel' => $request->id_mapel,
                        'id_guru' => $request->id_guru,
                    ]);
                }
            }
        }

        return response()->json(['success' => 'Data tersimpan.']);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        PenetapanGuruMapel::where('id', $id)->delete();
        return response()->json(['success' => 'Data dihapus.']);
    }
}
