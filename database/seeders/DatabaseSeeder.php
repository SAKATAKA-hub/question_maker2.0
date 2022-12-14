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
        // \App\Models\User::factory(10)->create();
        $this->call(FakeUserSeeder::class);        // フェイクユーザー
        $this->call(FakeQuestinonSeeder::class);   // フェイク問題
        $this->call(ViolationReportTypesSeeder::class);   // 通報の種類

    }
}
