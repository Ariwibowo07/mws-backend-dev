<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class SpatieRoleSeeder extends Seeder
{
    public function run()
    {
        // Pastikan role teacher ada dengan guard yang benar
        $role = Role::firstOrCreate(
            ['name' => 'teacher', 'guard_name' => 'sanctum'],
            ['uuid' => (string) Str::uuid()] // generate UUID manual
        );

        // Assign role ke semua user dengan users.role = teacher
        $teachers = User::where('role', 'teacher')->get();

        foreach ($teachers as $teacher) {
            if (!$teacher->hasRole($role)) {
                $teacher->assignRole($role); // otomatis pakai UUID
            }
        }
    }
}
