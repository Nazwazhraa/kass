<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');

        $query = Permission::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('display_name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $permissions = $query->paginate($perPage);

        return view('permissions.index', compact('permissions'));
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Permission::whereIn('id', $ids)->delete();
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'display_name' => 'nullable',
            'description' => 'nullable',
        ]);

        $permissionData = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
        ];

        $permission = Permission::create($permissionData);

        if ($permission) {
            Session::flash('success', 'Permission Berhasil Di Buat');
            return redirect()->route('permissions.index');
        } else {
            Session::flash('error', 'Gagal Membuat Permission');
            return redirect()->route('permissions.index');
        }
    }

    public function show($id)
    {
        $permission = Permission::find($id);

        if ($permission) {
            return view('permissions.show', compact('permission'));
        } else {
            Session::flash('error', 'Permission Tidak Ada');
            return redirect()->route('permissions.index');
        }
    }


    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();

        if ($permission) {
            Session::flash('success', 'Permission Berhasil Di Ubah');
            return redirect()->route('permissions.index');
        } else {
            Session::flash('error', 'Gagal Mengubah Permission');
            return redirect()->route('permissions.index');
        }
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            Session::flash('error', 'Permission tidak ditemukan');
            return redirect()->route('permissions.index');
        }

        $rolesWithPermission = $permission->roles;

        if ($rolesWithPermission->count() > 0) {
            Session::flash('error', 'Tidak dapat menghapus permission yang masih terkait dengan roles.');
            return redirect()->route('permissions.index');
        }

        $permission->delete();
        Session::flash('success', 'Permission berhasil dihapus');
        return redirect()->route('permissions.index');
    }
}
