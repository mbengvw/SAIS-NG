<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(\App\QueryServices\StudentQueryService $queryService)
    {
        try {
            $student = $queryService->getStudentProfile();
            $user = Auth::user();
            return view('siswa_dashboard.index', compact('student', 'user'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', $e->getMessage());
        }
    }

    public function updateProfile(Request $request, \App\Services\StudentProfileService $profileService)
    {
        // Validate request
        $validatedData = $request->validate([
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:150',
            'nama_ibu' => 'nullable|string|max:150',
            'nama_wali' => 'nullable|string|max:150',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/siswa'), $filename);
            $validatedData['foto'] = 'uploads/siswa/' . $filename;
        }

        try {
            $student = $profileService->updateProfile($validatedData);
            return response()->json([
                'success' => true, 
                'message' => 'Profil berhasil diperbarui!',
                'data' => $student
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Gagal memperbarui profil: ' . $e->getMessage()
            ]);
        }
    }
}
