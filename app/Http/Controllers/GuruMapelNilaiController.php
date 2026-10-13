<?php

namespace App\Http\Controllers;

use App\QueryServices\NilaiQueryService;
use App\Services\NilaiService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruMapelNilaiController extends Controller
{
    protected NilaiQueryService $queryService;

    protected NilaiService $service;

    public function __construct(NilaiQueryService $queryService, NilaiService $service)
    {
        $this->queryService = $queryService;
        $this->service = $service;
    }

    /**
     * Halaman utama penilaian kelas (Daftar komponen + Tab Rekap)
     */
    public function index($id_penetapan)
    {
        $idGuru = Auth::id();

        try {
            $dataRekap = $this->queryService->getRekapNilaiKelas((int) $id_penetapan, $idGuru);
            $komponen = $this->queryService->getKomponenByPenetapan((int) $id_penetapan, $idGuru);

            return view('gurumapel.nilai.index', [
                'penetapan' => $dataRekap['penetapan'],
                'komponen' => $komponen,
                'rekap' => $dataRekap['rekap'],
            ]);
        } catch (Exception $e) {
            return redirect()->route('gurumapel.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Halaman input nilai per komponen (Mobile-First)
     */
    public function inputNilai($id_komponen)
    {
        $idGuru = Auth::id();

        try {
            $komponen = $this->queryService->getKomponenDetail((int) $id_komponen, $idGuru);
            $siswaList = $this->queryService->getSiswaWithNilai((int) $id_komponen, $idGuru);

            return view('gurumapel.nilai.input', [
                'komponen' => $komponen,
                'penetapan' => $komponen->penetapan,
                'siswaList' => $siswaList,
            ]);
        } catch (Exception $e) {
            return redirect()->route('gurumapel.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Tambah komponen nilai baru (AJAX / Form Submit)
     */
    public function storeKomponen(Request $request, $id_penetapan)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:100',
            'jenis' => 'nullable|string|max:50',
            'bobot' => 'nullable|integer|min:1',
            'urutan' => 'nullable|integer|min:1',
        ]);

        try {
            $komponen = $this->service->tambahKomponen((int) $id_penetapan, Auth::id(), $request->all());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Komponen nilai berhasil ditambahkan.',
                    'data' => $komponen,
                ]);
            }

            return redirect()->route('gurumapel.nilai.index', $id_penetapan)
                ->with('success', 'Komponen nilai berhasil ditambahkan.');
        } catch (Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update komponen nilai (AJAX / Form Submit)
     */
    public function updateKomponen(Request $request, $id_komponen)
    {
        $request->validate([
            'nama_komponen' => 'required|string|max:100',
            'jenis' => 'nullable|string|max:50',
            'bobot' => 'nullable|integer|min:1',
            'urutan' => 'nullable|integer|min:1',
        ]);

        try {
            $komponen = $this->service->updateKomponen((int) $id_komponen, Auth::id(), $request->all());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Komponen nilai berhasil diperbarui.',
                    'data' => $komponen,
                ]);
            }

            return redirect()->route('gurumapel.nilai.index', $komponen->id_penetapan)
                ->with('success', 'Komponen nilai berhasil diperbarui.');
        } catch (Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Hapus komponen nilai
     */
    public function destroyKomponen(Request $request, $id_komponen)
    {
        try {
            $this->service->hapusKomponen((int) $id_komponen, Auth::id());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Komponen nilai berhasil dihapus.',
                ]);
            }

            return redirect()->back()->with('success', 'Komponen nilai berhasil dihapus.');
        } catch (Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Simpan nilai siswa secara batch untuk 1 komponen (AJAX)
     */
    public function storeNilaiBatch(Request $request, $id_komponen)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'nullable|array',
            'catatan.*' => 'nullable|string|max:255',
        ]);

        $payload = [];
        foreach ($request->nilai as $idSiswa => $val) {
            $payload[] = [
                'id_siswa' => $idSiswa,
                'nilai' => $val,
                'catatan' => $request->catatan[$idSiswa] ?? null,
            ];
        }

        try {
            $this->service->simpanNilaiBatch((int) $id_komponen, Auth::id(), $payload);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Nilai siswa berhasil disimpan!',
                ]);
            }

            return redirect()->back()->with('success', 'Nilai siswa berhasil disimpan!');
        } catch (Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
