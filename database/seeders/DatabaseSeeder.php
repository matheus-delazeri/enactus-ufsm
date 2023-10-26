<?php

namespace Database\Seeders;

use App\Models\User\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        \App\Models\User::create([
            'name' => 'Admin',
            'user' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ])->assignRole(Role::SUPER_ADMIN);

        \App\Models\User::create([
            'name' => 'Editor',
            'user' => 'editor',
            'email' => 'editor@editor.com',
            'password' => bcrypt('editor')
        ])->assignRole(Role::EDITOR);

    }
}
