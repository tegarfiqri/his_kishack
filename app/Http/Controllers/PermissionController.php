<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $query = new Permission;
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
        $page = (int) ceil($totalDataCount / 10);
        return Inertia::render('Permissions/Index', [
            'data' => $data,
            'filters' => $request->only(['search']),
            'page' => $page
        ]);
    }

    public function create()
    {
        return Inertia::render('Permissions/Create', []);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return Inertia::render('Permissions/Edit', [
            'data' => $permission,
        ]);
    }

    public function show(Permission $permission)
    {
        return Inertia::render('Permissions/Show', [
            'data' => $permission,
        ]);
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updateData = [
            'name' => $request->name,
        ];

        $permission->update($updateData);
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission): void
    {
        $permission->delete();
    }
}
