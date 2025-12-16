<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($role) {
            if (empty($role->uuid)) {
                $role->uuid = (string) Str::uuid();
            }
        });
    }
}
