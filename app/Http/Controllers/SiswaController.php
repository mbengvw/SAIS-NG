<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSiswaRequest;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id_siswa . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '<button type="button" name="delete" id="' . $row->id_siswa . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    $button .= '<button type="button" name="non" id="' . $row->id_siswa . '" class="non btn btn-warning btn-sm">Non-aktif</button>';
                    return $button;
                })

                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id_siswa}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('siswa.siswa');
    }

    public function destroy($id_siswa)
    {
        Siswa::find($id_siswa)->delete();
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
            'no_daftar'     =>  $request->no_daftar,
            'nis'           =>  $request->nis,
            'nisn'          =>  $request->nisn,
            'nama_lengkap'  =>  $request->nama,
            'jk'            =>  $request->jk,
            'angkatan'      =>  $request->angkatan,
            'jalur'         =>  $request->jalur,
            'asal_sltp'     =>  $request->asal_sltp
        );

        $post = Siswa::updateOrCreate(['id_siswa' => $id_siswa], $form_data);
        return response()->json($post);
    }


    function show($id_siswa)
    {
        $where = array('id_siswa' => $id_siswa);
        $siswa  = Siswa::where($where)->first();

        return response()->json($siswa);
    }
}
