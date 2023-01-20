<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(FakeUserSeeder::class);        // フェイクユーザー
        // $this->call(FakeQuestinonSeeder::class);   // フェイク問題
        // $this->call(ViolationReportTypesSeeder::class);   // 通報の種類

        $this->call(SurveyInputTypesTableSeeder::class); //質問内容登録用の入力フォームの種類
    }
}
