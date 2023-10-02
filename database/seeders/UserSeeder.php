<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::create([
            'name'    => 'Admin',
            'last_name'     => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('12345678'),
            'role_id'       => 1,
            'image'     => 'assets/images/blank.png'
        ]);

       
        $coachUser = User::create([
            'name'    => 'Demo',
            'last_name'     => 'Coach',
            'email'         => 'democoach@gmail.com',
            'password'      => Hash::make('12345678'),
            'role_id'       => 2,
            'image'    => 'assets/images/blank.png'
        ]);
    }
}
