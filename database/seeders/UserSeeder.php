<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
                        [
                            'name' => "Super Admin",
                            'username' => "super-admin",
                            'email' => "admin@example.com",
                            'role' => "Super Admin",
                        ],
                        [
                            'name' => "System Admin",
                            'username' => "system-admin",
                            'email' => "sysadmin@example.com",
                            'role' => "System Admin",
                        ],
                        [
                            'name' => "System Manager",
                            'username' => "system-manager",
                            'email' => "sysmanager@example.com",
                            'role' => "System Manager",
                        ],
                        [
                            'name' => "System User",
                            'username' => "system-user",
                            'email' => "sysuser@example.com",
                            'role' => "System User",
                        ],
                    ];

                    foreach ($usersData as $userData) {
                        $user = User::create([
                            'name' => $userData['name'],
                            'username' => $userData['username'],
                            'email' => $userData['email'],
                            'email_verified_at' => now(),
                            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                            'remember_token' => Str::random(10),
                        ]);

                        $user->assignRole($userData['role']);
                    }

        
      
    }
}