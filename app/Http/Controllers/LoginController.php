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
            if (auth()->user()->admin == 1) {
                return redirect('/admin/dashboard');
            } elseif (auth()->user()->piket == 1) {
                return redirect('/piket');
            } else {
                $tahun = TahunService::getActive();
                $walikelas = WalikelasService::isWalikelas(auth()->user()->id,$tahun->id);
                if($walikelas){
                    return redirect('/walikelas');
                }else{
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

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'admin' => $data['level']
        ]);

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
            $tahun = TahunService::getActive()->alias_tahun;
            return view('home', ['nama' => Auth::user()->name, 'tahun' => $tahun]);
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
