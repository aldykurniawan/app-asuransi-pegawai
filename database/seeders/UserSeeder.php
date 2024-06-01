<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Role::get() as $key => $value) {
            $user = User::create([
                'email'     => $value->name.'@'.$value->name.'.com',
                'username'  => $value->name,
                'name'      => $value->name,
                'is_active' => 1,
                'password'  => bcrypt('admin123'),
            ]);
            $roles = Role::where('name', [$value->name])->pluck('name')->toArray();
            $user->assignRole($roles);
        }
    }
}
