<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Grouping;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Presensi;
use App\Services\GroupingService;
use App\Services\TahunService;

class GroupingController extends Controller
{
    private GroupingService $groupingService;

    public function __construct(GroupingService $groupingService)
    {
        $this->groupingService = $groupingService;
    }

    public function index(Request $request)
    {
        $list_kelas = Kelas::where('id_tahun', '=', TahunService::getActive()->id)->get();
        if ($request->ajax()) {
            $grouped_id = Grouping::all()->where('id_tahun', '=', TahunService::getActive()->id)->pluck('id_siswa');
            $data = Siswa::whereNotIn('id_siswa', $grouped_id)->where('status', '=', 'A')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id_siswa . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="' . $row->id_siswa . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id_siswa}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('grouping.index', ['list_kelas' => $list_kelas, 'data_th_akademik' => app('tahunAkademik')]);
    }


    public function ajaxbykelas(Request $request)
    {
        /**
         * Fungsi untuk mengambil data siswa hasil pengkelasan bedasarkan kelas dan tahun aktif 
         */

        $id_tahun = TahunService::getActive()->id;

        if ($request->ajax()) {
            $id_kelas = $request->input('id_kelas');
            $list_grouping = $this->groupingService->listGrouping($id_kelas, $id_tahun);

            return response()->json([
                'students' => $list_grouping,
            ]);
        }
    }


    function createall(Request $request)
    {
        /**
         * Fungsi untuk menambahkan data ke tabel tst_grouping
         * input : array id_siswa dan id_kelas
         */

        $list_id = $request->input('list_id');
        $id_kelas = $request->input('id_kelas');
        $id_tahun = TahunService::getActive()->id;

        $this->groupingService->doGrouping($list_id, $id_kelas, $id_tahun);
    }


    /**
     * Fungsi untuk menghapus pengkelasan
     */
    public function ajaxdestroy(Request $request)
    {
        if ($request->ajax()) {
            $id_grouping = $request->input('id');
            $res = $this->groupingService->destroy($id_grouping);
            return $res;
        }
    }
}
