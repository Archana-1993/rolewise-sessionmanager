<?php

namespace Itpathsolutions\Sessionmanager\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class SessionManagerController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('sessionmanager::home', compact('roles'));
    }

    public function updateSession(Request $request)
    {
        $role = Role::find($request->role_id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }
        $role->session_lifetime = $request->session_lifetime;
        $role->save();

        return response()->json(['success' => 'Session timeout updated successfully']);
    }


}
