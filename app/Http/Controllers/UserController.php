<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = new User;
        $totalDataCount = $query->count();
        if ($request->has('search') && $request->get('search') != '') {
            $query = $query->where('name', 'like', "%{$request->get('search')}%")
                ->orWhere('email', 'like', "%{$request->get('search')}%");
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
        return Inertia::render('Users/Index', [
            'data' => $data,
            'filters' => $request->only(['search']),
            'page' => $page
        ]);
    }

    public function create()
    {
        $role = Role::all();
        return Inertia::render('Users/Create', [
            'roles' => $role
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $image = $request->file('image');
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('images'), $image_name);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'image_name' => $image_name ?? null,
            'image_path' => $image_name ? 'images/' . $image_name : null,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $role = Role::all();
        return Inertia::render('Users/Edit', [
            'data' => $user,
            'roles' => $role
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class . ',email,' . $user->id,
        ]);
        $image = $request->file('image');
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('images'), $image_name);
        }
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'image_name' => $image_name ?? $user->image_name,
            'image_path' => $image_name ? 'images/' . $image_name : $user->image_path,
        ];
        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $updateData['password'] = Hash::make($request->password);
        }
        $user->update($updateData);
        return redirect()->route('users.index');
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }
}
