<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermission extends Controller
{
    public function index() {
        return view('administrator.assign-permission.index', [
            'role' => Role::with('permissions')->get()
        ]);
        // return Role::with('permissions')->get();
    }

    public function edit($id) {
        return view('administrator.assign-permission.edit', [
            'role_has_pemissions' => Role::with('permissions')->where('id', $id)->first(),
            'permission' => Permission::all()
        ]);
    }

    public function store(Request $request){
        $role = Role::findOrFail($request->role_id);
        $rhs = Role::with('permissions')->where('id', $request->role_id)->first();
        foreach($rhs->permissions as $item) {
            $role->revokePermissionTo($item->name);
        }
        foreach($request->permissions as $permission) {
            $role->givePermissionTo($permission);
        }
        return redirect('/assign-permission');
    }
}
