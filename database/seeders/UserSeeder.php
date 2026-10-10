<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Super Admin',
                'email'    => 'superadmin@sii.com',
                'password' => 'superadmin123',
                'role'     => 'super_admin',
            ],
            [
                'name'     => 'HR Admin',
                'email'    => 'hradmin@sii.com',
                'password' => 'hradmin123',
                'role'     => 'hr_admin',
            ],
            [
                'name'     => 'Reviewer',
                'email'    => 'reviewer@sii.com',
                'password' => 'reviewer123',
                'role'     => 'reviewer',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
