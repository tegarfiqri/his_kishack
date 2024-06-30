<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $query = new Role;
        $totalDataCount = $query->count();
        if ($request->has('search') && $request->get('search') != '') {
            $query = $query->where('name', 'like', "%{$request->get('search')}%");
        }
        if ($request->has('sortBy') && $request->get('sortBy') != '') {
            $query = $query->orderBy($request->get('sortBy'), $request->get('sortDesc') === 'true' ? 'desc' : 'asc');
        }
        if ($request->has('page') && $request->get('page') != '') {
            $query = $query->skip(($request->get('page') - 1) * 10)->take(10);
        }

        $data = $query->get();
        $dataCount = count($data);
        $page = (int) ceil($totalDataCount / 10);
        return Inertia::render('Roles/Index', [
            'data' => $data,
            'filters' => $request->only(['search']),
            'page' => $page
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return Inertia::render('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $role = Role::create([
            'name' => $request->name,
        ]);

        foreach ($request->permissions as $permission) {
            $role->rolePermissions()->firstOrCreate(['permission_id' => $permission, 'role_id' => $role->id]);
        }

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return Inertia::render('Roles/Edit', [
            'data' => $role,
            'permissionsList' => $permissions,
            'rolePermissions' => $role->rolePermissions
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updateData = [
            'name' => $request->name,
        ];

        $role->update($updateData);

        $removeOldPermissions = $role->rolePermissions()->whereNotIn('permission_id', $request->permissions)->get();
        foreach ($removeOldPermissions as $permission) {
            $permission->delete();
        }

        foreach ($request->permissions as $permission) {
            $role->rolePermissions()->firstOrCreate(['permission_id' => $permission, 'role_id' => $role->id]);
        }

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role): void
    {
        $role->delete();
    }
}
