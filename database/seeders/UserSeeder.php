<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = User::create([
            'name' => 'Admin',
            'email' => 'coodect.manager@gmail.com',
            'password' => Hash::make('coodect2020'),
            'connected_google' => 1
        ]);
        $administrator->assignRole('Administrador');
    }
}
