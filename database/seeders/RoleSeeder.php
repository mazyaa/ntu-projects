<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Dashboard
            'dashboard.view',

            // Articles
            'articles.view',
            'articles.create',
            'articles.edit',
            'articles.delete',
            'articles.publish',
            'articles.archive',

            // Categories
            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',

            // Tags
            'tags.view',
            'tags.create',
            'tags.delete',

            // Services
            'services.view',
            'services.create',
            'services.edit',
            'services.delete',

            // Riksa Uji
            'riksa_uji.view',
            'riksa_uji.create',
            'riksa_uji.edit',
            'riksa_uji.delete',

            // Equipment
            'equipment.view',
            'equipment.create',
            'equipment.edit',
            'equipment.delete',

            // Projects
            'projects.view',
            'projects.create',
            'projects.edit',
            'projects.delete',

            // Team
            'team.view',
            'team.create',
            'team.edit',
            'team.delete',

            // Pages
            'pages.view',
            'pages.create',
            'pages.edit',
            'pages.delete',

            // Media
            'media.view',
            'media.upload',
            'media.delete',

            // Settings
            'settings.view',
            'settings.edit',

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Contacts
            'contacts.view',
            'contacts.manage',

            // Activity Logs
            'activity_logs.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        // Super Admin gets all permissions
        $superAdmin->syncPermissions($permissions);

        // Admin gets content management permissions (no user/settings management)
        $adminPermissions = [
            'dashboard.view',
            'articles.view', 'articles.create', 'articles.edit', 'articles.delete', 'articles.publish', 'articles.archive',
            'categories.view', 'categories.create', 'categories.edit', 'categories.delete',
            'tags.view', 'tags.create', 'tags.delete',
            'services.view', 'services.create', 'services.edit', 'services.delete',
            'riksa_uji.view', 'riksa_uji.create', 'riksa_uji.edit', 'riksa_uji.delete',
            'equipment.view', 'equipment.create', 'equipment.edit', 'equipment.delete',
            'projects.view', 'projects.create', 'projects.edit', 'projects.delete',
            'team.view', 'team.create', 'team.edit', 'team.delete',
            'pages.view', 'pages.create', 'pages.edit', 'pages.delete',
            'media.view', 'media.upload', 'media.delete',
            'contacts.view', 'contacts.manage',
            'activity_logs.view',
        ];
        $admin->syncPermissions($adminPermissions);

        // Editor gets limited content permissions
        $editorPermissions = [
            'articles.view', 'articles.create', 'articles.edit',
            'categories.view', 'categories.create', 'categories.edit',
            'tags.view', 'tags.create', 'tags.delete',
            'media.view', 'media.upload',
        ];
        $editor->syncPermissions($editorPermissions);
    }
}
