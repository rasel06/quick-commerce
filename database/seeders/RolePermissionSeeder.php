<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions
        $permissions = [
            'catalog.manage',
            'user.manage',
            'order.manage',
            'order.own',
            'catalog.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Administrator']);
        $dataEntry = Role::firstOrCreate(['name' => 'Data Entry Operator']);
        $orderManager = Role::firstOrCreate(['name' => 'Order Manager']);
        $member = Role::firstOrCreate(['name' => 'Member']);
        $visitor = Role::firstOrCreate(['name' => 'Visitor']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo(['catalog.manage', 'user.manage', 'order.manage']);

        $dataEntry->givePermissionTo(['catalog.manage']);

        $orderManager->givePermissionTo(['order.manage']);

        $member->givePermissionTo(['order.own']);

        $visitor->givePermissionTo(['catalog.view']);
    }
}
