<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserRolesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions

        # USERS
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'list users']);

        # DOCTORS
        Permission::create(['name' => 'create doctors']);
        Permission::create(['name' => 'manage doctors']);
        Permission::create(['name' => 'list doctors']);

        # CS
        Permission::create(['name' => 'create cs']);
        Permission::create(['name' => 'manage cs']);

        # Appointment
        Permission::create(['name' => 'create appointment']);
        Permission::create(['name' => 'manage appointment']);

        # Assesment
        Permission::create(['name' => 'create assessment']);
        Permission::create(['name' => 'manage assessment']);

        # Tickets
        Permission::create(['name' => 'create ticket']);
        Permission::create(['name' => 'manage ticket']);
        Permission::create(['name' => 'list ticket']);

        # Media
        Permission::create(['name' => 'create media']);
        Permission::create(['name' => 'manage media']);

        # Content & Settings
        Permission::create(['name' => 'manage content']);
        Permission::create(['name' => 'manage settings']);



        // Create roles and assign existing permissions

        # Super Admin
        $role_super_admin = Role::create(['name' => 'Super-Admin']);


        # Manager
        $role_manager = Role::create(['name' => 'manager']);
        $role_manager->givePermissionTo('manage users');
        $role_manager->givePermissionTo('manage doctors');
        $role_manager->givePermissionTo('manage cs');
        $role_manager->givePermissionTo('manage content');
        $role_manager->givePermissionTo('manage settings');
        $role_manager->givePermissionTo('manage appointment');
        $role_manager->givePermissionTo('list ticket');

        # Customer Support Agent
        $role_support_agent = Role::create(['name' => 'support-agent']);
        $role_support_agent->givePermissionTo('list users');
        $role_support_agent->givePermissionTo('list doctors');
        $role_support_agent->givePermissionTo('list ticket');
        $role_support_agent->givePermissionTo('manage ticket');
        $role_support_agent->givePermissionTo('manage appointment');

        # User
        $role_user = Role::create(['name' => 'user']);
        $role_user->givePermissionTo('list doctors');
        $role_user->givePermissionTo('create appointment');
        $role_user->givePermissionTo('manage appointment');
        $role_user->givePermissionTo('create ticket');
        $role_user->givePermissionTo('manage ticket');

        # Doctor
        $role_doctor = Role::create(['name' => 'doctor']);
        $role_doctor->givePermissionTo('manage appointment');
        $role_doctor->givePermissionTo('create assessment');
        $role_doctor->givePermissionTo('manage assessment');
        $role_doctor->givePermissionTo('create ticket');
        $role_doctor->givePermissionTo('manage ticket');
    }
}
