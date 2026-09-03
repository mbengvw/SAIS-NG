<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::with('permissions')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function($row){
                    $badges = '';
                    foreach($row->permissions as $perm) {
                        $badges .= '<span class="badge badge-info mr-1">'.$perm->name.'</span>';
                    }
                    return $badges ?: '<span class="text-muted">Tidak ada</span>';
                })
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="btn btn-warning btn-sm editRoleBtn mr-1" data-id="'.$row->id.'"><i class="fa fa-edit"></i> Edit</button>';
                    if(!in_array($row->name, ['admin'])) {
                        $btn .= '<button type="button" class="btn btn-danger btn-sm deleteRoleBtn" data-id="'.$row->id.'"><i class="fa fa-trash"></i> Hapus</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }

        $permissions = Permission::all();
        return view('roles.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array'
        ]);

        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }
            DB::commit();
            return response()->json(['success' => 'Role berhasil ditambahkan.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Gagal menambahkan role: ' . $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return response()->json(['role' => $role, 'rolePermissions' => $rolePermissions]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'nullable|array'
        ]);

        $role = Role::findOrFail($id);
        
        // Prevent editing default admin role name
        if ($role->name === 'admin' && $request->name !== 'admin') {
            return response()->json(['error' => 'Role admin tidak boleh diubah namanya.'], 403);
        }

        DB::beginTransaction();
        try {
            $role->name = $request->name;
            $role->save();
            
            $permissions = $request->has('permissions') ? $request->permissions : [];
            $role->syncPermissions($permissions);
            
            DB::commit();
            return response()->json(['success' => 'Role berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Gagal memperbarui role: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if ($role->name === 'admin') {
            return response()->json(['error' => 'Role admin tidak boleh dihapus.'], 403);
        }

        $role->delete();
        return response()->json(['success' => 'Role berhasil dihapus.']);
    }
}
