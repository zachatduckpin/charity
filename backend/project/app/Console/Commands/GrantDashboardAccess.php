<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class GrantDashboardAccess extends Command
{
    protected $signature = 'dashboard:grant-access
                            {admin : An admin ID or email address}
                            {--role=Dashboard Administrator : A dashboard role to assign}
                            {--password= : Optionally reset the admin password to a known value}';

    protected $description = 'Assign a prepared dashboard role to one existing admin account and optionally reset its password.';

    public function handle(): int
    {
        $identifier = (string) $this->argument('admin');
        $admin = Admin::query()
            ->where('id', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if (! $admin) {
            $this->error("No admin was found for [{$identifier}].");

            return self::FAILURE;
        }

        $role = Role::query()
            ->where('name', (string) $this->option('role'))
            ->where('guard_name', 'admin')
            ->first();

        if (! $role) {
            $this->error('The requested dashboard role does not exist. Run the DashboardRoleSeeder first.');

            return self::FAILURE;
        }

        $admin->assignRole($role);

        if (filled($this->option('password'))) {
            $admin->password = Hash::make((string) $this->option('password'));
            $admin->save();
            $this->info("Assigned [{$role->name}] to {$admin->email} and updated the login password.");
        } else {
            $this->info("Assigned [{$role->name}] to {$admin->email}.");
        }

        return self::SUCCESS;
    }
}
