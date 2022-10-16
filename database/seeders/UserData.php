<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'bendahara',
                'username' => 'bendahara',
                'password' => bcrypt('123456'),
                'level' => 1,
                'email' => 'bendahara@gmail.com'
            ],
            [
                'name' => 'wali kelas',
                'username' => 'wali_kelas',
                'password' => bcrypt('123456'),
                'level' => 2,
                'email' => 'wali_kelas@gmail.com'
            ],
            [
                'name' => 'murid',
                'username' => 'murid',
                'password' => bcrypt('123456'),
                'level' => 3,
                'email' => 'murid@gmail.com'
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        };
    }
}
