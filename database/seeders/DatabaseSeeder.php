<?php

namespace Database\Seeders;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@colegio.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');
    }
}
