<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardRoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'dashboard.view',
            'campaigns.view',
            'campaigns.create',
            'campaigns.update',
            'donations.view',
            'events.view',
            'members.view',
            'members.create',
            'members.update',
            'members.delete',
            'membership-applications.view',
            'member-leadership.view',
            'member-profile.view',
            'member-operations.view',
            'membership-options.view',
            'handbook.view',
            'video-library.view',
            'resource-centre.view',
            'accreditation.view',
            'accreditation-application.view',
            'accreditation-workspace.view',
            'accreditation-reviewer-training.view',
            'priority-queue.view',
            'engagement.view',
            'authority-levels.view',
            'roles.manage',
        ];

        foreach ($permissions as $name) {
            Permission::findOrCreate($name, 'admin');
        }

        $roles = [
            'Dashboard Administrator' => $permissions,
            'Operations Manager' => [
                'dashboard.view', 'campaigns.view', 'campaigns.create', 'campaigns.update',
                'donations.view', 'events.view', 'members.view', 'members.create', 'members.update', 'members.delete', 'membership-applications.view',
                'member-leadership.view', 'member-profile.view', 'member-operations.view',
                'membership-options.view', 'handbook.view', 'video-library.view', 'resource-centre.view',
                'accreditation.view', 'accreditation-application.view', 'accreditation-workspace.view',
                'accreditation-reviewer-training.view', 'priority-queue.view', 'engagement.view', 'authority-levels.view',
            ],
            'Dashboard Viewer' => [
                'dashboard.view', 'campaigns.view', 'donations.view', 'events.view', 'members.view', 'membership-applications.view',
                'member-leadership.view', 'member-profile.view', 'member-operations.view',
                'membership-options.view', 'handbook.view', 'video-library.view', 'resource-centre.view',
                'accreditation.view', 'accreditation-application.view', 'accreditation-workspace.view',
                'accreditation-reviewer-training.view', 'priority-queue.view', 'engagement.view', 'authority-levels.view',
            ],
        ];

        foreach ($roles as $name => $rolePermissions) {
            $role = Role::findOrCreate($name, 'admin');
            $role->syncPermissions($rolePermissions);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $dashboardAdministrator = Role::findByName('Dashboard Administrator', 'admin');
        $operationsManager = Role::findByName('Operations Manager', 'admin');

        Admin::query()->each(function (Admin $admin) use ($dashboardAdministrator, $operationsManager): void {
            $dashboardRole = strcasecmp((string) $admin->role, 'staff') === 0
                ? $operationsManager
                : $dashboardAdministrator;

            $admin->assignRole($dashboardRole);
        });
    }
}
