<?php

use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolePermission::insert([
            [
                'role_id' => 1,
                'role_permission' => 'donations'
            ],
            [
                'role_id' => 1,
                'role_permission' => 'donations/verify'
            ],
            [
                'role_id' => 1,
                'role_permission' => 'logs'
            ],
            [
                'role_id' => 1,
                'role_permission' => 'donations/add'
            ],
            [
                'role_id' => 1,
                'role_permission' => 'donations/edit'
            ],
        ]);
    }
}
