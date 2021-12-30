<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index() {
        return view('user.profile.change-password');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::findOrFail(Crypt::decrypt($id));
        $user->forceFill([
            'password' => Hash::make($request['password']),
        ])->save();
        // $user->password = Hash::make($request->password);
        // $user->save();
        return redirect()->route('manage-password.index')->with('status', 'Password successfully changed...');
    }
}
