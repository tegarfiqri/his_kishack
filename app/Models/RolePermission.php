<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'id', 'permission_id');
    }
}
