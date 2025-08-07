<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'super admin',
            'email' => 'superadmin@csirt',
            'email_verified_at' => now(),
            'password' => bcrypt('111')
        ]);
        $superadmin->assignRole('super_admin');

        $admin = User::create([
            'name' => 'super admin',
            'email' => 'admin@csirt',
            'email_verified_at' => now(),
            'password' => bcrypt('111')
        ]);
        $admin->assignRole('agen');
    }
}
