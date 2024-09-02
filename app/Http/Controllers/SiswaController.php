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
}
