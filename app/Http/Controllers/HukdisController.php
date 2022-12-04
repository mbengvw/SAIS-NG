<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hukdis;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use App\Traits\SiswaTrait;

class HukdisController extends Controller
{
    use SiswaTrait;
    
    public function index(){
        $data_ta=app('tahunAkademik');
        $list_kelas=Kelas::all();
        $list_hukdis=Hukdis::all();
        return view('hukdis.index',[
            'list_kelas'=>$list_kelas,
            'tanggal'=>date("d/m/Y"),
            'list_hukdis'=>$list_hukdis,
            'data_th_akademik'=>$data_ta
        ]);
    }

    public function list_by(){
        $query=DB::table('tst_pelanggaran AS pelanggaran')
        ->select('pelanggaran.id_pelanggaran','pelanggaran.id_hukdis','pelanggaran.id_grouping','pelanggaran.tanggal','pelanggaran.id_petugas',
        'grouping.id_siswa','grouping.id_kelas','grouping.tahun_akademik',
        'hukdis.deskripsi','hukdis.poin',
        'siswa.nis','siswa.nama_lengkap','siswa.jk','siswa.angkatan','siswa.jalur','siswa.asal_sltp',
        'kelas.id_kelas','kelas.nama_kelas')
        ->join('mst_hukdis AS hukdis','hukdis.id_hukdis','=','pelanggaran.id_hukdis')
        ->join('tst_grouping AS grouping','pelanggaran.id_grouping','=','grouping.id_grouping')
        ->join('mst_siswa AS siswa','grouping.id_siswa','=','siswa.id_siswa')
        ->join('mst_kelas AS kelas','grouping.id_kelas','=','kelas.id_kelas')
        ->orderBy('siswa.nama_lengkap','asc');

        $result=$query->get();
        dd($result);

    }

    public  function ajax_list_by(Request $request){
        if ($request->ajax()) {
            $id_kelas=$request->input('id_kelas');
            $tahun=$request->input('tahun');
            $semester=$request->input('semester');
            $tgl=$request->input('tanggal');
            $nama=$request->input('nama');

            $query=DB::table('tst_pelanggaran AS pelanggaran')
            ->select('pelanggaran.id_pelanggaran','pelanggaran.id_hukdis','pelanggaran.id_grouping','pelanggaran.tanggal','pelanggaran.id_petugas',
            'grouping.id_siswa','grouping.id_kelas','grouping.tahun_akademik',
            'hukdis.deskripsi','hukdis.poin',
            'siswa.nis','siswa.nama_lengkap','siswa.jk','siswa.angkatan','siswa.jalur','siswa.asal_sltp',
            'kelas.id_kelas','kelas.nama_kelas')
            ->join('mst_hukdis AS hukdis','hukdis.id_hukdis','=','pelanggaran.id_hukdis')
            ->join('tst_grouping AS grouping','pelanggaran.id_grouping','=','grouping.id_grouping')
            ->join('mst_siswa AS siswa','grouping.id_siswa','=','siswa.id_siswa')
            ->join('mst_kelas AS kelas','grouping.id_kelas','=','kelas.id_kelas')
            ->orderBy('siswa.nama_lengkap','asc');
            if($id_kelas){
                $query->where('kelas.id_kelas','=',$id_kelas);
            }
            if($semester){
                $query->where('kehadiran.semester','=',$semester);
            }
            if($tgl){
                $query->where('kehadiran.tanggal','=',$tgl);
            }
            if($nama!=""){
                $query->where('siswa.nama_lengkap','LIKE','%'.$nama.'%');
            }
            $result=$query->get();

            return response()->json([
                'students'=>$result,
            ]);
        }
    }

    public function list_siswa_by_tahun($tahun){
        $list_siswa=$this->list_siswa_by($tahun);
        dd($list_siswa);
    }

}
