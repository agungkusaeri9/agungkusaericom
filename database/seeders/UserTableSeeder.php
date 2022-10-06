<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
        $cw = User::create([
            'name' => 'Agung Kusaeri',
            'username' => 'agungkusaeri',
            'email' => 'agungkusaeri@gmail.com',
            'password' => bcrypt('content writer')
        ]);
        $admin1->assignRole('admin');
        $cw->assignRole('content writer');
    }
}
