<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // users
            'view users',
            'create users',
            'update users',
            'delete users',

            // levels
            'view levels',
            'create levels',
            'update levels',
            'delete levels',

            // grades
            'view grades',
            'create grades',
            'update grades',
            'delete grades',

            // subjects
            'view subjects',
            'create subjects',
            'edit subjects',
            'delete subjects',

            // lessons
            'view lessons',
            'create lessons',
            'edit lessons',
            'delete lessons',

            // enrollments
            'view enrollments',
            'create enrollments',
            'edit enrollments',
            'delete enrollments',

            // student specific permission
            'view enrolled subjects',

            // teacher specific permission
        ];

        foreach ($permissions as $permission) {
            Permission::create(["name" => $permission]);
        }
    }
}
