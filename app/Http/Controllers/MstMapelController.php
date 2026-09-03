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

    public function downloadTemplate()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template_mst_mapel.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $columns = ['nama_mapel', 'tingkat', 'jurusan', 'deskripsi'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            // Add example row
            fputcsv($file, ['Matematika', '10', 'Umum', 'Mata Pelajaran Matematika Kelas 10']);
            fputcsv($file, ['Biologi', '11', 'IPA', 'Mata Pelajaran Biologi Kelas 11']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function uploadCSV(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'File tidak valid. Pastikan format CSV.');
        }

        $file = $request->file('csv_file');
        $fileHandle = fopen($file->getPathname(), 'r');
        $header = fgetcsv($fileHandle); // skip header

        $count = 0;
        while (($row = fgetcsv($fileHandle)) !== false) {
            if (count($row) >= 4) {
                MstMapel::create([
                    'nama_mapel' => $row[0],
                    'tingkat'    => $row[1],
                    'jurusan'    => $row[2],
                    'deskripsi'  => $row[3],
                ]);
                $count++;
            }
        }
        fclose($fileHandle);

        return redirect()->back()->with('success', $count . ' data berhasil diunggah.');
    }
}
