<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'level_id' => 1,
                'username' => 'admin',
                'nama' => 'Administrator',
                'password' => Hash::make('12345'), // class untuk mengenkripsi/hash password
            ],
            [
                'user_id' => 2,
                'level_id' => 2,
                'username' => 'manager',
                'nama' => 'Manager',
                'password' => Hash::make('12345'),
            ],
            [
                'user_id' => 3,
                'level_id' => 3,
                'username' => 'staff',
                'nama' => 'Staff/Kasir',
                'password' => Hash::make('12345'),
            ],
            [
                'user_id' => 23,
                'level_id' => 3,
                'username' => 'FarrelCaesarian  ',
                'nama' => 'Staff/Kasir',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => 24,
                'level_id' => 1,
                'username' => 'FarrelAdmin  ',
                'nama' => 'Administrator',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => 25,
                'level_id' => 2,
                'username' => 'FarrelManager',
                'nama' => 'Manager',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => 26,
                'level_id' => 3,
                'username' => 'FarrelStaff',
                'nama' => 'Staff/Kasir',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => 27,
                'level_id' => 6,
                'username' => 'FarrelCustomer',
                'nama' => 'Customer',
                'password' => Hash::make('123456'),
            ],
        ];

        DB::table('m_user')->insert($data);
    }
}
