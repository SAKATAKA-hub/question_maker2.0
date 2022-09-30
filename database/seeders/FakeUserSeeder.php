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
            'name'     => 'Next Arrow',
            'email'    => 'nextarrow.line@gmail.com',
            'password' => Hash::make('password'),
            'image'    => 'site/image/next_icon.png',
            'key'      =>\Illuminate\Support\Str::random(40)
        ]);
        $user->save();
        $mail_setting = new  \App\Models\MailSetting([
            'user_id' => $user->id,
            'keep_question_group' => 0,
            'keep_creator_user'   => 0,
            'comment'             => 0,
            'infomation'          => 0,
        ]);
        $mail_setting->save();


        $user = new \App\Models\User([
            'name'     => 'さかい　たかひろ',
            'email'    => 'aek1214@yahoo.co.jp',
            'password' => Hash::make('password'),
            'image'    => 'site/image/sakai.png',
            'key'      =>\Illuminate\Support\Str::random(40)
        ]);
        $user->save();
        $mail_setting = new  \App\Models\MailSetting([ 'user_id' => $user->id]);
        $mail_setting->save();



        /* ログインしていないユーザー用アカウント */
        $user = new \App\Models\User([
            'name'     => 'ゲスト',
            'email'    => env('GEST_MAIL_ADDRESS'),
            'password' => Hash::make('password'),
            'key'      =>\Illuminate\Support\Str::random(40)
        ]);
        $user->save();
        $mail_setting = new  \App\Models\MailSetting([
            'user_id' => $user->id,
            'keep_question_group' => 0,
            'keep_creator_user'   => 0,
            'comment'             => 0,
            'infomation'          => 0,
        ]);
        $mail_setting->save();

    }


}
