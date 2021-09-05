<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Example User',
                'email'          => 'user@example.com',
                'password'       => '$2y$10$Y.jEitizf.DW3V7gxCnMr.SdWN2i1w4gobo28vTLGaFajqcjUl8Oy',
                'remember_token' => null,
                'created_at'     => '2021-09-03 21:08:28',
                'updated_at'     => '2019-09-03 19:08:28',
            ]
        ];

        User::insert($users);
    }
}
