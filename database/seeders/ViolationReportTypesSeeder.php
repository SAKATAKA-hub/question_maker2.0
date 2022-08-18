<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
/**
 * ===============================
 *  問題集の違反通報の種類
 * ===============================
 */
class ViolationReportTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $texts = [
            '特定の人物や団体を中傷する文章や画像が含まれる',
            '過度に性的な表現・画像などを含む',
            '過度に暴力的な的な表現・画像などを含む',
            '権利を持たない画像を使用している',
            '問の文章または解答に誤りがあり、クリエーターに指摘しても改善されない',
        ];


        foreach ($texts as $text) {
            $type = new \App\Models\ViolationReportType([
                'text' =>  $text
            ]);
            $type->save();
        }

    }
}
