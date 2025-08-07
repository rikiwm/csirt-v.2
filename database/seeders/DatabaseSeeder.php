<?php

namespace Database\Seeders;

use App\Models\Categori;
use App\Models\Menu;
use App\Models\Post;
// use App\Models\Page;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->roles();
        $this->call([
            ShieldSeeder::class,
            UserSeeder::class,
        ]);
        $this->call(SetupSeeder::class);
}

    private function roles()
    {
        Role::create(['name' => 'super_admin']);
        Role::create(['name' => 'agen']);
        Role::create(['name' => 'user']);
    }
}
