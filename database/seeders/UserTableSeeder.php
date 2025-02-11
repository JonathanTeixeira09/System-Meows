<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'adm@adm.com',
            'password' => bcrypt('Admin@2023'),
            'profissionals_id' => '1',
            'status' => 'Ativo',
            'role' => 'superadmin',
        ]);
    }
}
