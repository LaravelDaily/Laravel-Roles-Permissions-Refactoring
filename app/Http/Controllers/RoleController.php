<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions, []);

        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $role->load('permissions');

        $permissions = Permission::all()->pluck('name', 'id');

        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        throw_if($role->permissions->count(),
            ValidationException::withMessages(['has_permissions' => 'Cannot delete role witch has permissions.'])
        );

        $role->delete();

        return redirect()->route('roles.index');
    }
}