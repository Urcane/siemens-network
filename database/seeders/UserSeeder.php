<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user1->assignRole('administrator');

        // $user2 = User::create([
        //     'name' => 'Admin Tarakan',
        //     'email' => 'operator_tarakan@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);
        // $user2->assignRole('operator');

        // $user3 = User::create([
        //     'name' => 'Admin Jatibarang',
        //     'email' => 'operator_jatibarang@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);
        // $user3->assignRole('operator');
        
        // $user4 = User::create([
        //     'name' => 'Admin Subang',
        //     'email' => 'operator_subang@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);
        // $user4->assignRole('operator');

        // $user5 = User::create([
        //     'name' => 'Admin Tambun',
        //     'email' => 'operator_tambun@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);
        // $user5->assignRole('operator');

        // $user7 = User::create([
        //     'name' => 'Admin Indonesia',
        //     'email' => 'operator_indonesia@gmail.com',
        //     'password' => bcrypt('12345678'),
        // ]);
        // $user7->assignRole('operator');
    }
}
