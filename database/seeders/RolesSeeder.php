<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
                $role = Role::create(['name' => 'Super Admin'])->givePermissionTo(Permission::all());
                $user = User::first();
                $user->assignRole($role);
                Role::create(['name' => 'Manager']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("##### RolesSeeder->run  #####". $e->getMessage());
        }
    }
}
