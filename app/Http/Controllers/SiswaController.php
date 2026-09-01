<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSiswaRequest;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Student;
use App\Services\SiswaService;
use App\Services\TahunService;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    $button .= '<button type="button" name="non" id="' . $row->id . '" class="non btn btn-warning btn-sm">Non-aktif</button>';
                    return $button;
                })

                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('siswa.siswa');
    }

    public function destroy($id_siswa)
    {
        Student::find($id_siswa)->delete();
        return response()->json(['success' => 'Product deleted successfully.']);
    }

    function removeall(Request $request)
    {
        $user_id_array = $request->input('id');
        $user = Siswa::whereIn('id_siswa', $user_id_array);
        if ($user->delete()) {
            echo 'Data Deleted';
        }
    }

    public function generateAccounts(\App\Services\StudentAccountService $accountService)
    {
        try {
            $result = $accountService->generateAccounts();
            $msg = $result['new'] . ' akun baru dibuat. ';
            if ($result['synced'] > 0) {
                $msg .= $result['synced'] . ' akun lama disinkronkan emailnya (karena perubahan NISN).';
            }
            
            return response()->json([
                'success' => true,
                'message' => $msg
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    function store(NewSiswaRequest $request)
    {

        $id_siswa = $request->id_siswa;

        $form_data = array(
            'nama'          =>  $request->nama,
            'nisn'          =>  $request->nisn,
            'nik'           =>  $request->nik,
            'tahun_masuk'   =>  $request->tahun_masuk,
            'tempat_lahir'  =>  $request->tempat_lahir,
            'tanggal_lahir' =>  $request->tanggal_lahir,
            'status'        =>  $request->status,
            'jenis_kelamin' =>  $request->jenis_kelamin,
            'alamat'        =>  $request->alamat,
            'nama_ayah'     =>  $request->nama_ayah,
            'nama_ibu'      =>  $request->nama_ibu,
            'nama_wali'     =>  $request->nama_wali,
        );

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/siswa'), $filename);
            $form_data['foto'] = 'uploads/siswa/' . $filename;
        }

        $post = Student::updateOrCreate(['id' => $id_siswa], $form_data);
        return response()->json($post);
    }

    function show($id_siswa)
    {
        $where = array('id' => $id_siswa);
        $siswa  = Student::where($where)->first();

        return response()->json($siswa);
    }

    public function detail($id_siswa)
    {
        $tahun = TahunService::getActive()->tahun;
        $res = SiswaService::detail($id_siswa, $tahun);
        return $res;
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template_siswa.csv',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        $columns = ['Nama', 'NISN', 'NIK', 'Tahun Masuk', 'Tempat Lahir', 'Tanggal Lahir (YYYY-MM-DD)', 'Status', 'Jenis Kelamin (L/P)', 'Alamat', 'Nama Ayah', 'Nama Ibu', 'Nama Wali'];

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        
        $fileHandle = fopen($file->getPathname(), 'r');
        
        // Detect separator by reading the first line
        $firstLine = fgets($fileHandle);
        $separator = strpos($firstLine, ';') !== false ? ';' : ',';
        
        // Reset file pointer to the beginning
        rewind($fileHandle);

        $header = fgetcsv($fileHandle, 0, $separator); // Read first row as header

        while (($data = fgetcsv($fileHandle, 0, $separator)) !== FALSE) {
            // Convert array elements to UTF-8 to handle Windows-1252/ANSI from Excel
            $data = array_map(function($value) {
                return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1'); // or Windows-1252
            }, $data);

            // Check if row has enough columns
            if (count($data) >= 12 && !empty($data[1])) {
                
                // Format tanggal lahir dari DD/MM/YYYY ke YYYY-MM-DD
                $tanggal_lahir = $data[5];
                if (strpos($tanggal_lahir, '/') !== false) {
                    try {
                        $tanggal_lahir = \Carbon\Carbon::createFromFormat('d/m/Y', trim($tanggal_lahir))->format('Y-m-d');
                    } catch (\Exception $e) {
                        // Kalau format aneh, biarkan aslinya, atau handle misal m/d/Y
                    }
                }

                Student::updateOrCreate(
                    ['nisn' => $data[1]], // using nisn as unique identifier
                    [
                        'nama' => $data[0],
                        'nik' => $data[2],
                        'tahun_masuk' => $data[3],
                        'tempat_lahir' => $data[4],
                        'tanggal_lahir' => $tanggal_lahir,
                        'status' => $data[6],
                        'jenis_kelamin' => $data[7],
                        'alamat' => $data[8],
                        'nama_ayah' => $data[9],
                        'nama_ibu' => $data[10],
                        'nama_wali' => $data[11],
                    ]
                );
            }
        }
        
        fclose($fileHandle);

        return redirect()->back()->with('success', 'Data siswa berhasil diupload dari CSV.');
    }
}
