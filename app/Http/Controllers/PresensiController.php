<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Grouping;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Presensi;

use function PHPUnit\Framework\isNull;

class PresensiController extends Controller
{
    public function index(Request $request){
        $list_kelas=Kelas::all();
        if ($request->ajax()) {
            $tgl='2022-11-20';
            $id_kelas=2;
            $data=Grouping::select(['tst_grouping.*','mst_siswa.*','mst_kelas.*','tst_kehadiran.*'])
            ->join('mst_siswa','tst_grouping.id_siswa','=','mst_siswa.id_siswa')
            ->join('mst_kelas','tst_grouping.id_kelas','=','mst_kelas.id_kelas')
            ->orderBy('mst_siswa.nama_lengkap','asc')
            ->join('tst_kehadiran','tst_kehadiran.id_grouping','=','tst_grouping.id_grouping')
            ->where('tst_grouping.id_kelas',$id_kelas)
            ->where('tst_kehadiran.tanggal',$tgl)
            ->get();
        }
        return view('presensi.index',['list_kelas'=>$list_kelas]);
    }

    public function test(){
        $data_tahun=app('tahunAkademik');
        echo $data_tahun->alias_tahun;

    }

    public  function ajaxkelastanggal(Request $request){
        if ($request->ajax()) {
            $id_kelas=$request->input('id_kelas');
            $tgl=date("Y/m/d");

            $data_peresensi=DB::table('tst_kehadiran')
            ->select('*')
            ->where('tanggal',$tgl);
            
            $result=DB::table('tst_grouping')->select('tst_grouping.id_grouping',
            'data_presensi.id_kehadiran','data_presensi.semester','data_presensi.tanggal','data_presensi.status','data_presensi.keterangan',
            'mst_siswa.nis','mst_siswa.nama_lengkap','mst_siswa.jk',
            'mst_kelas.nama_kelas')
            ->leftJoinSub($data_peresensi,'data_presensi',function($join){
                $join->on('tst_grouping.id_grouping','=','data_presensi.id_grouping');
            })
            ->join('mst_siswa','tst_grouping.id_siswa','=','mst_siswa.id_siswa')
            ->join('mst_kelas','tst_grouping.id_kelas','=','mst_kelas.id_kelas')
            ->orderBy('mst_siswa.nama_lengkap','asc')
            ->where('tst_grouping.id_kelas',$id_kelas)
            ->get();

            return response()->json([
                'students'=>$result,
            ]);
        }
    }

    public function store(Request $request){
        if ($request->ajax()) {

            $id_grouping=$request->input('id_grouping');
            $tgl=date("Y/m/d");
            $semester=1;
            $my_data=array(
                'id_grouping'   =>  $id_grouping,
                'status'        =>$request->input('status'),
                'keterangan'    =>$request->input('keterangan'),
                'tanggal'       =>$tgl,
                'semester'      =>$semester
            );
            $post=Presensi::updateOrCreate(['id_grouping'=>$id_grouping,'tanggal'=>$tgl],$my_data);
            return response()->json($my_data);
        }
    }

    public function ajaxdestroy(Request $request){
        if ($request->ajax()) {
            $id_kehadiran=$request->input('id_kehadiran');
            Presensi::find($id_kehadiran)->delete();
            return response()->json(['success'=>'Grouping deleted successfully.']);
        }
    }


}
