<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User([
            'name' => '山田　太郎',
            'email' => 'aek1214@yahoo.co.jp',
            'password' => Hash::make('password'),
        ]);
        $user->save();

        $user = new \App\Models\User([
            'name' => 'gest user',
            'email' => 'contact@next-arrow.co.jp',
            'password' => Hash::make('password'),
        ]);
        $user->save();
    }
}
