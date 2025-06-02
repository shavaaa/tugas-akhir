<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
        
        if (!Role::where('name', 'Pengguna')->exists()) {
            Role::create(['name' => 'Pengguna']);
        }

        // Create admin user
        $admin = User::create([
            'name' => 'Annisa',
            'email' => 'annisa@yeosin.com',
            'password' => Hash::make('admin1'),
        ]);
        $admin->assignRole('Admin');
        
        // Create customer users
        $customer1 = User::create([
            'name' => 'Pelanggan 1',
            'email' => 'pelanggan1@yeosin.com',
            'password' => Hash::make('pelanggan1'),
        ]);
        $customer1->assignRole('Pengguna');
        
        $customer2 = User::create([
            'name' => 'Pelanggan 2',
            'email' => 'pelanggan2@yeosin.com',
            'password' => Hash::make('pelanggan2'),
        ]);
        $customer2->assignRole('Pengguna');

        // Call other seeders
        $this->call([
            ServiceSeeder::class,
            BeauticianSeeder::class,
        ]);
    }
}


