<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ana Komaria Baskara',
            'email' => 'ana@respontime.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('Admin');

        $petugas = User::create([
            'name' => '',
            'email' => '',
            'password' => bcrypt('')
        ]);

        $petugas->assignRole('Petugas Lab');
    }
}
