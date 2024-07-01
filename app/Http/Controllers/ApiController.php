<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getPermissions()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $permissions = [];
        foreach ($user->role->rolePermissions as $rolePermission) {
            foreach ($rolePermission->permissions as $permission) {
                $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }
}
