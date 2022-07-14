<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(20);//Get all roles

        return view('backend.roles.index')->with('roles', $roles);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);//Get role with the given id
        $role->fill($input)->save();
        
        $p_all = Permission::all(); //Get all permissions

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }
    
    public function destroy($id)
    {
        return redirect()->route('role.index')->with('error', 'Role cannot be deleted.');
    }
}
