<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Grouping;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Presensi;

class GroupingController extends Controller
{
    public function index(Request $request){
        $list_kelas=Kelas::all();
        if ($request->ajax()) {
            $grouped_id=Grouping::all()->pluck('id_siswa');
            $data=Siswa::whereNotIn('id_siswa',$grouped_id)->get();
            // $data = Siswa::latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<button type="button" name="edit" id="'.$row->id_siswa.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                        $button .= '   <button type="button" name="edit" id="'.$row->id_siswa.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                        return $button;
                    })
                    ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id_siswa}}" />')
                    ->rawColumns(['checkbox','action'])
                    ->make(true);
        }
        return view('grouping.index',['list_kelas'=>$list_kelas]);
    }

    public function ajaxbykelas(Request $request){
        if ($request->ajax()) {
            $id_kelas=$request->input('id_kelas');
            // $list_grouping=Grouping::with(
            //     ['rel_siswa',
            //     'rel_kelas'])
            // ->where('id_kelas',$id_kelas)
            // ->orderBy(Siswa::select('nama_lengkap')->whereColumn('id_siswa','mst_siswa.id_siswa'))
            // ->get();
            $list_grouping=Grouping::select(['tst_grouping.*','mst_siswa.*','mst_kelas.*'])
            ->join('mst_siswa','tst_grouping.id_siswa','=','mst_siswa.id_siswa')
            ->join('mst_kelas','tst_grouping.id_kelas','=','mst_kelas.id_kelas')
            ->orderBy('mst_siswa.nama_lengkap','asc')
            ->where('tst_grouping.id_kelas',$id_kelas)
            ->get();
            return response()->json([
                'students'=>$list_grouping,
            ]);
        }
    }

    function createall(Request $request)
    {
        $list_id = $request->input('list_id');
        $id_kelas = $request->input('id_kelas');
        $tahun_akademik='2022';
        foreach($list_id as $id_siswa){
            $data=array(
                'id_siswa'=>$id_siswa,
                'id_kelas'=>$id_kelas,
                'tahun_akademik'=>$tahun_akademik
            );
            Grouping::insert($data);
        }
    }


    public function ajaxdestroy(Request $request){
        if ($request->ajax()) {
            $id_grouping=$request->input('id');
            //cek apakah sudah ada transaksi kerhadiran
            if(Presensi::where('id_grouping',$id_grouping)->count()<1){
                Grouping::find($id_grouping)->delete();
                return response()->json(['message'=>'Data grouping berhasil dihapus']);
            }else{
                return response()->json(['message'=>'Sudah ada transaksi kehadiran']);
            }
        }
    }

}
