<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        #dashboard
        Permission::firstOrCreate(['group' => 'dashboard','name' => 'View Admin Count Statistics', 'is_active' => 1, 'type'=> 1, 'module'=>'default']);
        Permission::firstOrCreate(['group' => 'dashboard','name' => 'View Manger Count Statistics', 'is_active' => 1, 'type'=> 1, 'module'=>'default']);
        Permission::firstOrCreate(['group' => 'dashboard','name' => 'View Users Count Statistics', 'is_active' => 1, 'type'=> 1, 'module'=>'default']);
        Permission::firstOrCreate(['group' => 'dashboard','name' => 'View Total Revenue Count Statistics', 'is_active' => 1, 'type'=> 1, 'module'=>'default']);

        #profile
        Permission::firstOrCreate(['group'=> 'user profile', 'name' => 'View Profile', 'is_active'=>1, 'type'=> 1, 'module'=>'default']);
        Permission::firstOrCreate(['group'=> 'user profile', 'name' => 'Edit Profile', 'is_active'=>1, 'type'=> 1, 'module'=>'default']);
        Permission::firstOrCreate(['group'=> 'user profile', 'name' => 'Change Password', 'is_active'=>1, 'type'=> 1, 'module'=>'default']);

        #admin
        Permission::firstOrCreate(['group'=> 'admin', 'name' => 'View All Admin', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'admin', 'name' => 'Create Admin', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'admin', 'name' => 'View Admin Details', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'admin', 'name' => 'Edit Admin', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'admin', 'name' => 'Delete Admin', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);

        #designer
        Permission::firstOrCreate(['group'=> 'manager', 'name' => 'View All Manager', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'manager', 'name' => 'Create Manager', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'manager', 'name' => 'View Manager Details', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'manager', 'name' => 'Edit Manager', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'manager', 'name' => 'Delete Manager', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);

        #User
        Permission::firstOrCreate(['group'=> 'user', 'name' => 'View All Users', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'user', 'name' => 'Create User', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'user', 'name' => 'View User Details', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'user', 'name' => 'Edit User', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'user', 'name' => 'Delete User', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);

        #Role
        Permission::firstOrCreate(['group'=> 'role', 'name' => 'View All Roles', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'role', 'name' => 'Create Role', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'role', 'name' => 'View Role Details', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);
        Permission::firstOrCreate(['group'=> 'role', 'name' => 'Edit Role', 'is_active'=>1, 'type'=> 1, 'module'=>'users']);

    }
}
