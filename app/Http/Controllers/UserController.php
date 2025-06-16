<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::with('roles')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name')->all();
        return Inertia::render('Users/CreateUser', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);

        return to_route('users.index')->with('success', 'User Created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name')->all();
        return Inertia::render('Users/EditUser', [
            'user' => $user,
            'userRoles' => $user->roles()->pluck('name')->all(),
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => '',
            'password_confirmation' => 'same:password'
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->syncRoles($request->roles);
        return to_route('users.index')->with('success', 'User Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
