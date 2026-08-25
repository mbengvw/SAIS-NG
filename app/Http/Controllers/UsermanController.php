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
                    $button = '<button type="button" name="assign_roles" id="' . $row->id . '" data-name="' . $row->name . '" class="assign-role btn btn-warning btn-sm me-1"> <i class="bi bi-person-check-fill"></i> Assign Role</button>';
                    $button .= '<button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm me-1"> <i class="bi bi-pencil-square"></i> Reset Password</button>';
                    $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
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
            $default_pass = Hash::make('123456');
            $user->password = $default_pass;
            $user->save();
            return response()->json(['message' => 'Password berhasil direset menjadi 123456!']);
        }
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        
        $fileHandle = fopen($file->getPathname(), 'r');
        
        // Detect separator by reading the first line
        $firstLine = fgets($fileHandle);
        $separator = strpos($firstLine, ';') !== false ? ';' : ',';
        
        // Reset file pointer to the beginning
        rewind($fileHandle);

        $header = fgetcsv($fileHandle, 0, $separator); // Read first row as header

        while (($data = fgetcsv($fileHandle, 0, $separator)) !== FALSE) {
            // Check if row has enough columns
            if (count($data) >= 2 && !empty($data[0]) && !empty($data[1])) {
                
                $name = $data[0];
                $email = $data[1];
                $password = isset($data[2]) && !empty($data[2]) ? $data[2] : $email;

                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => $name,
                        'password' => Hash::make($password)
                    ]
                );

                if ($request->role) {
                    $user->assignRole($request->role);
                }
            }
        }
        
        fclose($fileHandle);

        return response()->json(['success' => 'Data User berhasil diupload.']);
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template_user.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Name', 'Email', 'Password'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns, ';');
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getUserRoles($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = $user->roles->pluck('name');
        return response()->json($roles);
    }

    public function assignRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $roles = $request->roles ?? [];
        $user->syncRoles($roles);

        return response()->json(['success' => 'Role berhasil diperbarui']);
    }
}
