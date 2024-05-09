<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'nip' => '1234',
                'nama' => 'DONI',
                'jabatan' => 'DIREKTUR',
                'email' => 'doni@direktur.com',
                'password' => bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nip' => '1235',
                'nama' => 'DONO',
                'jabatan' => 'FINANCE',
                'email' => 'dono@finance.com',
                'password' => bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nip' => '1236',
                'nama' => 'DONA',
                'jabatan' => 'STAFF',
                'email' => 'dona@staff.com',
                'password' => bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        foreach ($userData as $user) {
            User::insert($user);
        }
    }
}
