<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::with("permissions")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/CreateRole', [
            "permissions" => Permission::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', 'Role Created successfully.');
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
        $role = Role::with("permissions")->find($id);
        return Inertia::render('Roles/EditRole', [
            "role" => $role,
            "rolePermissions" => $role->permissions->pluck('name')->all(),
            "permissions" => Permission::pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', 'Role Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
