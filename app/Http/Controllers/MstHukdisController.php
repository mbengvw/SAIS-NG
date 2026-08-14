<?php

namespace App\Http\Controllers;

use App\Models\Hukdis;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MstHukdisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Hukdis::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_hukdis . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editHukdis">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id_hukdis . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteHukdis">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('mst_hukdis.index');
    }

    public function store(Request $request)
    {
        Hukdis::updateOrCreate(
            ['id_hukdis' => $request->id_hukdis],
            [
                'deskripsi' => $request->deskripsi,
                'poin' => $request->poin
            ]
        );

        return response()->json(['success' => 'Data saved successfully.']);
    }

    public function edit($id)
    {
        $hukdis = Hukdis::find($id);
        return response()->json($hukdis);
    }

    public function destroy($id)
    {
        Hukdis::find($id)->delete();
        return response()->json(['success' => 'Data deleted successfully.']);
    }

    public function downloadTemplate()
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template_mst_hukdis.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $columns = ['deskripsi', 'poin'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            // Add example row
            fputcsv($file, ['Merokok di lingkungan sekolah', '50']);
            fputcsv($file, ['Terlambat masuk kelas', '10']);
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
            if (count($row) >= 2) {
                Hukdis::create([
                    'deskripsi' => $row[0],
                    'poin'      => (int)$row[1]
                ]);
                $count++;
            }
        }
        fclose($fileHandle);

        return redirect()->back()->with('success', $count . ' data berhasil diunggah.');
    }
}
