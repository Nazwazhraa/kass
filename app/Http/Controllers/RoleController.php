<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');

        $query = Role::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('display_name', 'like', '%' . $search . '%');
        }

        $roles = $query->paginate($perPage);

        return view('roles.index', compact('roles'));
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Role::whereIn('id', $ids)->delete();
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'permissions' => 'required|array',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        $role->syncPermissions($request->input('permissions'));

        session()->flash('success', 'Role berhasil di tambahkan');
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }

        $permissions = $role->permissions;

        return view('roles.show', compact('role', 'permissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found');
        }

        $permissions = Permission::get();
        $rolePermissions = $role->permissions->pluck('id')->all();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'permissions' => 'array | required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        session()->flash('success', 'Role berhasil diubah');
        return redirect()->route('roles.index');
    }


    public function destroy($id)
{
    $role = Role::find($id);

    if (!$role) {
        session()->flash('error', 'Role tidak ada ');
        return redirect()->route('roles.index');
    }

    if (User::whereHas('roles', function ($query) use ($id) {
        $query->where('role_id', $id);
    })->count() > 0) {
        session()->flash('error', 'Tidak dapat menghapus Role yang masih terkait dengan User');
        return redirect()->route('roles.index');
    }

    $role->delete();

    session()->flash('success', 'Role berhasil dihapus');
    return redirect()->route('roles.index');
}


}
