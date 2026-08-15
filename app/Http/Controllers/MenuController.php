<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('roles')->orderBy('order')->get();
        $roles = Role::all();
        
        return view('menus.index', compact('menus', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'color_class' => 'nullable|string|max:100',
            'order' => 'required|integer',
            'roles' => 'array'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $menu = Menu::create([
            'title' => $request->title,
            'route_name' => $request->route_name,
            'icon' => $request->icon,
            'color_class' => $request->color_class ?? 'card-siswa',
            'order' => $request->order,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        if ($request->has('roles')) {
            $menu->roles()->sync($request->roles);
        }

        return response()->json(['success' => true, 'message' => 'Menu berhasil ditambahkan.']);
    }

    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'color_class' => 'nullable|string|max:100',
            'order' => 'required|integer',
            'roles' => 'array'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $menu->update([
            'title' => $request->title,
            'route_name' => $request->route_name,
            'icon' => $request->icon,
            'color_class' => $request->color_class ?? 'card-siswa',
            'order' => $request->order,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        if ($request->has('roles')) {
            $menu->roles()->sync($request->roles);
        } else {
            $menu->roles()->sync([]);
        }

        return response()->json(['success' => true, 'message' => 'Menu berhasil diperbarui.']);
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(['success' => true, 'message' => 'Menu berhasil dihapus.']);
    }
}
