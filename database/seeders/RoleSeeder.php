<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role4 = Role::create([
            'name' => 'administrator',
        ]);

        $role4 = Role::create([
            'name' => 'operator',
        ]);
    }
}
