<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PermissionCheckServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind('userCan', function ($app) {
            return function ($check) {
                $user = Auth::user();
                $permissions = [];
                foreach ($user->role->rolePermissions as $rolePermission) {
                    foreach ($rolePermission->permissions as $permission) {
                        $permissions[] = $permission->name;
                    }
                }

                return in_array($check, $permissions);
                // return $permissions;
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
