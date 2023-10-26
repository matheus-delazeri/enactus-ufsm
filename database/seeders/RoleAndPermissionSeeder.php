<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Reset permissions cache */
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seedPermissions();
        $this->seedRoles();
    }

    private function seedPermissions(): void
    {
        foreach ($this->permissionSources() as $sourceClass) {
            if (!enum_exists($sourceClass)) {
                throw new \InvalidArgumentException("Permission source classes must be enum");
            }

            foreach (array_column(call_user_func([$sourceClass, "cases"]), "name") as $permission) {
                Permission::create(['name' => $permission]);
            }
        }
    }

    private function permissionSources(): array
    {
        return [
            \App\Enums\Permissions\PostPermission::class,
            \App\Enums\Permissions\UserPermission::class
        ];
    }

    private function seedRoles(): void
    {
        \Spatie\Permission\Models\Role::create(['name' => \App\Models\User\Role::SUPER_ADMIN]);

        $editorPermissions = array_column([
            \App\Enums\Permissions\PostPermission::VIEW_ANY_POST,
            \App\Enums\Permissions\PostPermission::VIEW_SELF_POST,
            \App\Enums\Permissions\PostPermission::UPDATE_SELF_POST,
            \App\Enums\Permissions\PostPermission::DELETE_SELF_POST,
            \App\Enums\Permissions\PostPermission::CREATE_POST
        ], "name");

        \Spatie\Permission\Models\Role::create(['name' => \App\Models\User\Role::EDITOR])
            ->givePermissionTo($editorPermissions);
    }
}
