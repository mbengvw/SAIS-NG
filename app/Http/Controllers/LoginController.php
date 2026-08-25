<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\TahunService;
use App\Services\WalikelasService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (auth()->user()->hasRole('admin')) {
                return redirect('/admin/dashboard');
            } elseif (auth()->user()->hasRole('guru-piket')) {
                return redirect('/piket');
            } elseif (auth()->user()->hasRole('guru-mapel')) {
                return redirect('/gurumapel');
            } elseif (auth()->user()->hasRole('siswa')) {
                return redirect('/siswa/dashboard');
            } else {
                $tahun = TahunService::getActive();
                if (!$tahun) {
                    return "Tidak ada tahun aktif";
                }
                $walikelas = WalikelasService::isWalikelas(auth()->user()->id, $tahun->id);
                if ($walikelas) {
                    return redirect('/walikelas');
                } else {
                    return redirect('/guess');
                }
            }
        }
        return view('welcome');
    }

    function registration()
    {
        return view('login.registration');
    }


    function validate_registration(Request $request)
    {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
        ]);

        $data = $request->all();

        $user = User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        
        if (isset($data['level']) && $data['level'] == 1) {
            $user->assignRole('admin');
        }

        return redirect('login/registration')->with('success', 'Registration Completed, now you can login');
    }

    function validate_login(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect(url('/'))->with('success', 'Akun login salah');
        }
        return redirect(url('/'))->with('success', 'Akun login salah');
    }

    function dashboard()
    {
        if (Auth::check()) {
            $data_tahun = TahunService::getActive();
            $tahun = $data_tahun ? $data_tahun->alias_tahun : null;
            
            $dashboardData = [];
            if ($data_tahun) {
                $dashboardService = new \App\Services\DashboardService();
                $dashboardData = [
                    'stats' => $dashboardService->getWidgetStats($data_tahun->id),
                    'top_kelas' => $dashboardService->getTopKelasPelanggaran($data_tahun->id),
                    'top_siswa' => $dashboardService->getTopSiswaPelanggaran($data_tahun->id),
                    'trend_pelanggaran' => $dashboardService->getTrendPelanggaranBulanan($data_tahun->id),
                    'trend_presensi' => $dashboardService->getTrendPresensiBulanan($data_tahun->id),
                ];
            }

            return view('home', [
                'nama' => Auth::user()->name, 
                'tahun' => $tahun,
                'dashboard' => $dashboardData
            ]);
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('/');
    }
}
