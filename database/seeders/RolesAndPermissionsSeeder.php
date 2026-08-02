<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Permission groups and the actions available per group.
     * Keys map to permission names like "articles.create".
     */
    private const PERMISSION_GROUPS = [
        'dashboard' => ['view'],
        'articles' => ['view', 'view_all', 'create', 'edit', 'delete', 'publish', 'archive'],
        'services' => ['view', 'create', 'edit', 'delete'],
        'media' => ['view', 'upload', 'delete'],
        'categories' => ['view', 'create', 'edit', 'delete'],
        'tags' => ['view', 'create', 'edit', 'delete'],
        'contacts' => ['view', 'manage'],
        'seo' => ['view', 'edit'],
        'settings' => ['view', 'edit'],
        'analytics' => ['view'],
        'activity_logs' => ['view'],
        'users' => ['view', 'create', 'edit', 'delete'],
        'roles' => ['view', 'create', 'edit', 'delete'],
    ];

    /**
     * Role => permission mapping using {group}.{action} strings.
     * "Super Admin" receives every permission (via hasPermissionTo wildcard handling).
     */
    private const ROLE_PERMISSIONS = [
        'Super Admin' => '*',
        'Admin' => [
            'dashboard.view',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'media.view', 'media.upload', 'media.delete',
            'categories.view', 'categories.create', 'categories.edit', 'categories.delete',
            'tags.view', 'tags.create', 'tags.edit', 'tags.delete',
            'contacts.view', 'contacts.manage',
            'seo.view', 'seo.edit',
            'analytics.view',
            'activity_logs.view',
        ],
        'Editor' => [
            'dashboard.view',
            'articles.view', 'articles.create', 'articles.edit', 'articles.delete', 'articles.publish', 'articles.archive',
            'media.view', 'media.upload',
            'categories.view', 'tags.view',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = $this->createPermissions();

        $this->createRoles($permissions);
    }

    private function createPermissions(): array
    {
        $permissions = [];

        foreach (self::PERMISSION_GROUPS as $group => $actions) {
            foreach ($actions as $action) {
                $permissions["{$group}.{$action}"] = Permission::firstOrCreate([
                    'name' => "{$group}.{$action}",
                    'guard_name' => 'web',
                ]);
            }
        }

        return $permissions;
    }

    private function createRoles(array $permissions): void
    {
        foreach (self::ROLE_PERMISSIONS as $roleName => $rule) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            if ($rule === '*') {
                $role->syncPermissions(array_keys($permissions));
            } else {
                $role->syncPermissions($rule);
            }
        }
    }
}
