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
            'name' => 'Next Arrow',
            'email' => 'nextarrow.line@gmail.com',
            'password' => Hash::make('password'),
            'image' => 'site/image/next_icon.png',
        ]);
        $user->save();
        $user = new \App\Models\User([
            'name' => 'さかい　たかひろ',
            'email' => 'aek1214@yahoo.co.jp',
            'password' => Hash::make('password'),
            'image' => 'site/image/sakai.png',
        ]);
        $user->save();

        /* ログインしていないユーザー用アカウント */
        $user = new \App\Models\User([
            'name' => 'gest user',
            'email' => 'contact@next-arrow.co.jp',
            'password' => Hash::make('password'),
        ]);
        $user->save();

    }


}
