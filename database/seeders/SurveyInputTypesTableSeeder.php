<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
/*
 * ===============================================================
 *  [ アンケート調査( 質問内容登録用の入力フォームの種類 ) ]　Seeder
 * ===============================================================
 **/
class SurveyInputTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 従業員情報一覧
        $datalist = [
            ['code' => 1, 'input_text' => '文字列', 'input_name' => 'string', ],
            ['code' => 2, 'input_text' => 'ラジオ', 'input_name' => 'radios', ],
            ['code' => 3, 'input_text' => 'チェック', 'input_name' => 'checks', ],
            ['code' => 4, 'input_text' => 'セレクト', 'input_name' => 'select', ],
            ['code' => 5, 'input_text' => 'テキスト', 'input_name' => 'text', ],
        ];

        # 従業員情報の保存
        foreach ($datalist as $data)
        {
            $input_type = new \App\Models\SurveyInputType($data);
            $input_type->save();
        }

    }
}
