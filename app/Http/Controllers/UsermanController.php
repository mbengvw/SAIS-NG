<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsermanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->latest()->get();
            return Datatables::of($data)
                ->addColumn('roles_list', function ($row) {
                    $badges = '';
                    foreach ($row->roles as $role) {
                        $badges .= '<span class="badge badge-info me-1">' . $role->name . '</span> ';
                    }
                    return $badges ?: '<span class="badge badge-secondary">User Reguler</span>';
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Reset Password</button>';
                    $button .= '   <button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action', 'roles_list'])
                ->make(true);
        }
        $roles = \Spatie\Permission\Models\Role::all();
        return view('login.userman', compact('roles'));
    }

    public function destroy($id)
    {
        $my_id = Auth::user()->id;
        if ($id == $my_id) {
            return response()->json(['message' => 'Tidak bisa menghapus diri sendiri dong..']);
        } else {
            User::find($id)->delete();
            return response()->json(['message' => 'Product deleted successfully.']);
        }
    }

    function store(Request $request)
    {
        $id_user = $request->id_user;
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
        ]);

        $data = $request->all();

        $form_data = array(
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password'])
        );
        // dd($form_data);
        $post = User::updateOrCreate(['id' => $id_user], $form_data);
        
        if (isset($data['role'])) {
            $post->syncRoles([$data['role']]);
        } else {
            $post->syncRoles([]);
        }

        return response()->json($post);
    }

    function show($id)
    {
        $where = array('id' => $id);
        $user  = User::where($where)->first();

        return response()->json($user);
    }

    function reset($id)
    {
        $user = User::find($id);

        if ($user) {
            $default_pass = Hash::make($user->email);
            $user->password = $default_pass;
            $user->save();
            return response()->json(['message' => 'Password berhasil direset !']);
        }
    }
}
