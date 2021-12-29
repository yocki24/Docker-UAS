<?php

namespace Database\Seeders;

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
        // \App\Models\User::create([
        //     'nisn' => '123456',
        //     'name' => 'Syaifuddin',
        //     'date_of_birth' => '2000-11-03',
        //     'class' => 'XI',
        //     'major' => 'IPA',
        //     'password' => '123456',
        // ]);

        \App\Models\User::create([
            'nisn' => '14071994',
            'name' => 'Syaifuddin Zuhri',
            'date_of_birth' => '1994-07-14',
            'password' => '14071994',
            'status' => 'guru',
            'role' => 'adm',
        ]);
    }
}