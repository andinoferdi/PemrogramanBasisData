<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.role.index', compact('roles'));
    }

    public function create()
    {
        return view('dashboard.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required',
        ]);

        Role::create($request->all());
        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

   // Method edit
public function edit($id)
{
    $role = Role::find($id); 
    return view('dashboard.role.edit', compact('role'));
}

// Method update
public function update(Request $request, $id)
{
    $request->validate([
        'nama_role' => 'required',
    ]);

    $role = Role::find($id); 
    $role->update($request->all());

    return redirect()->route('role.index')->with('success', 'Role updated successfully.');
}

// Method destroy
public function destroy($id)
{
    $role = Role::find($id);
    $role->delete();

    return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
}

}
