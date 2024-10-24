<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Fetch roles for select dropdown
        return view('dashboard.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'idrole' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'idrole' => $request->idrole,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

   public function edit($id)
{
    $user = User::find($id);
    $roles = Role::all();
    return view('dashboard.user.edit', compact('user', 'roles'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required',
        'idrole' => 'required',
    ]);

    $user = User::find($id);
    $user->update($request->only(['username', 'idrole']));

    if ($request->password) {
        $user->update(['password' => bcrypt($request->password)]);
    }

    return redirect()->route('user.index')->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
