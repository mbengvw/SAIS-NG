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
    public function index(){
        $list_kelas=Kelas::all();
        return view('presensi.index',['list_kelas'=>$list_kelas,'tanggal'=>date("d/m/Y")]);
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
            return response()->json(['message'=>'Data kehadiran berhasil dihapus']);
        }
    }

    public function list_all(){
        $list_kelas=Kelas::all();
        return view('presensi.list_presensi',['list_kelas'=>$list_kelas]);
    }

    public function list_by(){
        $id_kelas=1;
        $peresensi=Presensi::with(['grouping'=>function($q){
            $q->where('id_siswa','=','174');
        }])
        ->get();
        dd($peresensi);
    }

    public  function ajax_list_by(Request $request){
        if ($request->ajax()) {
            $id_kelas=$request->input('id_kelas');
            $tahun=$request->input('tahun');
            $semester=$request->input('semester');
            $tgl=$request->input('tanggal');
            $nama=$request->input('nama');
            
            $query=DB::table('tst_kehadiran AS kehadiran')
            ->select('kehadiran.id_kehadiran','kehadiran.id_grouping','kehadiran.semester','kehadiran.tanggal','kehadiran.atatus',
            'grouping.id_siswa','grouping.id_kelas','grouping.tahun_akademik',
            'siswa.nis','siswa.nama_lengkap','siswa.jk','siswa.angkatan','siswa.jalur','siswa.asal_sltp',
            'kelas.id_kelas','kelas.nama_kelas')

            ->join('mst_siswa AS siswa','grouping.id_siswa','=','siswa.id_siswa')
            ->join('mst_kelas AS kelas','grouping.id_kelas','=','kelas.id_kelas')
            ->orderBy('siswa.nama_lengkap','asc');
            if($id_kelas){
                $query->where('kelas.id_kelas','=',$id_kelas);
            }
            if($tahun){
                $query->where('grouping.tahun_akademik','=',$tahun);
            }
            if($semester){
                $query->where('kehadiran.semester','=',$semester);
            }
            if($tgl){
                $query->where('kehadiran.tanggal','=',$tgl);
            }
            if($nama){
                $query->where('siswa.nama_lengkap','=',$nama);
            }
            $result=$query->get();

            return response()->json([
                'students'=>$result,
            ]);
        }
    }


}
