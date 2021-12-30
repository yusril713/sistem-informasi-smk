<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRoutes = Route::getRoutes()->get();
        return view('administrator.permission.index',[
            'routes' => $allRoutes,
            'permission' => Permission::all()
        ]);
    }

    public function store(Request $request){
        Permission::create(['name' => $request->name]);
        return redirect()->route('manage-permission.index');
    }

    public function destroy($id) {
        $permission = Permission::where('name', $id)->first();
        $permission->delete();
        return redirect()->route('manage-permission.index');
    }
}
