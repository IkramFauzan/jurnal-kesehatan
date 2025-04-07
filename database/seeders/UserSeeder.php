<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $admin = User::create([
        //     'given_name' => 'admin',
        //     'family_name' => 'admin',
        //     'afiliasi' => NULL,
        //     'country' => 'Indonesia',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('unhasrsgm2025')
        // ]);
        // $admin->assignRole('admin');

        // $reviewer = User::create([
        //     'given_name' => 'reviewer',
        //     'family_name' => 'reviewer',
        //     'afiliasi' => NULL,
        //     'country' => 'Indonesia',
        //     'email' => 'reviewer@gmail.com',
        //     'password' => bcrypt('unhasrsgm2025')
        // ]);
        // $reviewer->assignRole('reviewer');

        $reviewer = User::create([
            'given_name' => 'user',
            'family_name' => 'user',
            'afiliasi' => NULL,
            'country' => 'Indonesia',
            'email' => 'user@gmail.com',
            'password' => bcrypt('unhasrsgm2025')
        ]);
        $reviewer->assignRole('user');
    }
}
