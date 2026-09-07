<?php

namespace App\Http\Controllers;

use App\Services\KelasService;
use App\Services\RekapPresensiService;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanPresensiController extends Controller
{
    private RekapPresensiService  $rekapPresensiService;

    public function __construct(RekapPresensiService $rekapPresensiService)
    {
        $this->rekapPresensiService = $rekapPresensiService;
    }

    public function index()
    {
        $data_tahun = TahunService::getActive();
        $tahun = $data_tahun->tahun;
        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'guru-piket'])) {
            $list_kelas = KelasService::listKelasByTahun($tahun);
        } else if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
            $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
            $list_kelas = KelasService::listKelasById($id_kelas);
        } else {
            $list_kelas = collect([]);
        }

        return view('presensi.laporan_tab', ['list_kelas' => $list_kelas, 'data_tahun' => $data_tahun]);
    }

    public function getRekapPresensi(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $req_tahun = $request->input('tahun', $data_tahun->tahun);
            $req_semester = $request->input('semester', $data_tahun->semester);

            $data = $this->rekapPresensiService->rekapByKelasTahunSemeseter($id_kelas, $req_tahun, $req_semester);

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function listRekapRentangWaktu(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $data = $this->rekapPresensiService->rekapByRentangWaktu($id_kelas, $data_tahun->tahun, $start_date, $end_date);
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function listRekapTahunan(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $req_tahun = $request->input('tahun', $data_tahun->tahun);
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $data = $this->rekapPresensiService->rekapByKelasTahun($id_kelas, $req_tahun);
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
    }

    public function listRekapPresensiBulanan(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $id_kelas = $request->input('id_kelas');
            $user = auth()->user();

            if (!$user->hasAnyRole(['admin', 'guru-piket'])) {
                if (WalikelasService::isWalikelas($user->id, $data_tahun->id)) {
                    $id_kelas = WalikelasService::getIdKelas($user->id, $data_tahun->id);
                } else {
                    return DataTables::of(collect([]))->addIndexColumn()->make(true);
                }
            }

            $bulan = $request->input('bulan');
            $data = $this->rekapPresensiService->rekapByKelasTahunBulan($id_kelas, $data_tahun->tahun, $bulan);
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function listRekapPerSiswa(Request $request)
    {
        if ($request->ajax()) {
            $data_tahun = TahunService::getActive();
            $nama = $request->input('nama');
            $nisn = $request->input('nisn');
            
            $query = \App\Models\Presensi::with(['grouping.siswa', 'grouping.kelas'])
                ->whereHas('grouping', function($q) use ($data_tahun) {
                    $q->where('id_tahun', $data_tahun->id);
                });

            if (!empty($nama)) {
                $query->whereHas('grouping.siswa', function($q) use ($nama) {
                    $q->where('nama', 'like', '%' . $nama . '%');
                });
            }

            if (!empty($nisn)) {
                $query->whereHas('grouping.siswa', function($q) use ($nisn) {
                    $q->where('nisn', 'like', '%' . $nisn . '%');
                });
            }

            // If no filter is provided, return empty to not overload the table
            if (empty($nama) && empty($nisn)) {
                return DataTables::of(collect([]))->make(true);
            }

            $data = $query->orderBy('tanggal', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_siswa', function($row) {
                    return $row->grouping->siswa->nama ?? '-';
                })
                ->addColumn('nisn_siswa', function($row) {
                    return $row->grouping->siswa->nisn ?? '-';
                })
                ->addColumn('nama_kelas', function($row) {
                    return $row->grouping->kelas->nama_kelas ?? '-';
                })
                ->addColumn('action', function($row) {
                    $user = auth()->user();
                    $btn = '';
                    if ($user->hasRole('admin') || $user->admin == 1) {
                        $btn .= '<button type="button" class="btn btn-warning btn-sm btn-edit-presensi mr-1" data-id="'.$row->id_kehadiran.'" data-status="'.$row->status.'" data-keterangan="'.$row->keterangan.'"><i class="fa fa-edit"></i> Edit</button>';
                        $btn .= '<button type="button" class="btn btn-danger btn-sm btn-delete-presensi" data-id="'.$row->id_kehadiran.'"><i class="fa fa-trash"></i> Hapus</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function updatePresensi(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user->hasRole('admin') && $user->admin != 1) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya Admin yang dapat mengubah data.'], 403);
        }

        $request->validate([
            'status' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        $presensi = \App\Models\Presensi::findOrFail($id);
        $presensi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return response()->json(['success' => true, 'message' => 'Data absensi berhasil diupdate.']);
    }

    public function deletePresensi($id)
    {
        $user = auth()->user();
        if (!$user->hasRole('admin') && $user->admin != 1) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya Admin yang dapat menghapus data.'], 403);
        }

        $presensi = \App\Models\Presensi::findOrFail($id);
        $presensi->delete();

        return response()->json(['success' => true, 'message' => 'Data absensi berhasil dihapus.']);
    }

}
