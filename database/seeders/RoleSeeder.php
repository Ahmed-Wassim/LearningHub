<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create([
            "name" => "super-admin",
        ]);

        $teacher = Role::create(["name" => "teacher"]);

        $teacher->givePermissionTo([
            'view users',
            'view levels',
            'view grades',
            'view subjects',
            'view lessons',
            'create lessons',
            'edit lessons',
            'view enrollments',
        ]);

        $student = Role::create(["name" => "student"]);
        $student->givePermissionTo([
            'view enrolled subjects',
        ]);
    }
}
