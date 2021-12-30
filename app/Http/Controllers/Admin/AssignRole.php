<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRole extends Controller
{
    public function index() {
        return view('administrator.assign-role.index', [
            'user' => User::with('roles')->get(),
            'role' => Role::all()
        ]);
        // return User::with('roles')->get();
    }

    public function store(Request $request) {
        $user = User::findOrFail($request->id);
        $user->syncRoles($request->role);
        echo 'Role succesfully created...';
    }
}
