<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataRole = [
            'superadmin',
            'admin',
            'employee',
        ];

        foreach ($dataRole as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
    }
}
