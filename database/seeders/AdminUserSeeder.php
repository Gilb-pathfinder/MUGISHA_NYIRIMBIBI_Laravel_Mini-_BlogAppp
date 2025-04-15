<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user with unencrypted password
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@example.com';
        $admin->password = 'admin123'; // Unencrypted password
        $admin->is_admin = true;
        $admin->save();
    }
}
