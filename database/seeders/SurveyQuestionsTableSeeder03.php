<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
/*
 * =========================================
 *  *  [ アンケート調査( 質問項目 ) ]　Seeder
 * =========================================
 *  **/
class SurveyQuestionsTableSeeder03 extends Seeder
{

    public static function test()
    {
        return 'test成功！';
    }




    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        # アンケートタイトル
        $title = '『もんだいDIY』ご意見・ご感想アンケート';


        /**
         *  インプットタイプ一覧
         *
         *  $datalist = [
         *      ['code' => 1, 'input_text' => '文字列', 'input_name' => 'string', ],
         *      ['code' => 2, 'input_text' => 'ラジオ', 'input_name' => 'radios', ],
         *      ['code' => 3, 'input_text' => 'チェック', 'input_name' => 'checks', ],
         *      ['code' => 4, 'input_text' => 'セレクト', 'input_name' => 'select', ],
         *      ['code' => 5, 'input_text' => 'テキスト', 'input_name' => 'text', ],
         *  ];
        */

        # 質問項目一覧 --------------------------------------
        $datalist = [
            // [
            //     'text' => '文字列',
            //     'input_name' => 'string', //'文字列'
            //     'items'=>[],
            //     'placeholder' => 'placeholder',
            //     'required' => 1,
            //     'input_text' => null,
            // ],
            // [
            //     'text' => 'ラジオ',
            //     'input_name' => 'radios', //'ラジオ'
            //     'items'=>[ 'ラジオ1', 'ラジオ2', 'ラジオ3' ],
            //     'placeholder' => null,
            //     'required' => 1,
            //     'input_text' => null,
            // ],
            // [
            //     'text' => 'チェック',
            //     'input_name' => 'checks', //'チェック'
            //     'items'=>[ 'チェック1', 'チェック2', 'チェック3' ],
            //     'placeholder' => null,
            //     'required' => 0,
            //     'input_text' => null,
            // ],
            // [
            //     'text' => 'セレクト',
            //     'input_name' => 'select', //'セレクト'
            //     'items'=>[ 'セレクト1', 'セレクト2', 'セレクト3' ],
            //     'placeholder' => null,
            //     'required' => 1,
            //     'input_text' => null,
            // ],
            // [
            //     'text' => 'テキスト',
            //     'input_name' => 'text', //'テキスト'
            //     'items'=>[],
            //     'placeholder' => '文章の入力',
            //     'required' => 0,
            //     'input_text' => null,
            // ],
            [
                'text' => '当サイト『もんだいDIY』をどのような目的で利用していますか？（複数選択可）',
                'input_name' => 'checks',//'チェック'
                'items'=>[
                    '個人用の学習・試験対策として',
                    'チーム・仲間の教育・知識確認ツールとして',
                    '遊びとして',
                    'その他',
                ],
                'placeholder' => null,
                'required' => 0,
                'input_text' => null,
            ],
            [
                'text' => '当サイト『もんだいDIY』の使用頻度はどのくらいですか？',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '1 よく利用している',
                    '2 時々利用している',
                    '3 利用することがある',
                    '4 あまり利用していない',
                    '5 まったく利用していない',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => '当サイト『もんだいDIY』の使いやすさを5段階で評価すると？',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '1 とても使いやすい',
                    '2 使いやすい',
                    '3 ふつう',
                    '4 使いにくい',
                    '5 とても使いにくい',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => '当サイト『もんだいDIY』の機能の充実さをを5段階で評価すると？',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '1 とても充実している',
                    '2 充実している',
                    '3 ふつう',
                    '4 物足りない',
                    '5 とても物足りない',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => '当サイト『もんだいDIY』の機能で便利だと思う点を選択してください。（複数選択可）',
                'input_name' => 'checks',//'チェック'
                'items'=>[
                    '採点機能',
                    '制限時間を設定できる機能',
                    '解答方法の種類を選択できる機能',
                    '作った問題を非公開でもシェアできる機能',
                    'サイト利用が無料な点',
                    '広告表示が少ない点',
                    'シンプルで見やすい点',
                    'その他',
                ],
                'placeholder' => null,
                'required' => 0,
                'input_text' => null,
            ],
            [
                'text' => '当サイト『もんだいDIY』をこれからも利用したいと思いますか？',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '1 とても思う',
                    '2 まあまあ思う',
                    '3 どちらでもない',
                    '4 思わない',
                    '5 まったく思わない',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => '当サイト『もんだいDIY』を友達や知り合いに進めたいと思いますか？',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '1 とても思う',
                    '2 まあまあ思う',
                    '3 どちらでもない',
                    '4 思わない',
                    '5 まったく思わない',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => 'あなたの性別を教えてください。',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '女性',
                    '男性',
                    'その他',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => 'あなたの年代を教えてください。',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '10代以下',
                    '20代',
                    '30代',
                    '40代',
                    '50代',
                    '60代以上',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => '.あなたの属性を教えてください。',
                'input_name' => 'radios', //'ラジオ'
                'items'=>[
                    '会社員・公務員',
                    'パート・アルバイト',
                    '学生',
                    '専業主婦',
                    'その他',
                ],
                'placeholder' => null,
                'required' => 1,
                'input_text' => null,
            ],
            [
                'text' => '.当サイト『もんだいDIY』についてのご意見・ご感想・改善案などございましたらご入力ください。',
                'input_name' => 'text', //'テキスト'
                'items'=>[],
                'placeholder' => 'ご意見・ご感想をご入力ください。',
                'required' => 0,
                'input_text' => null,
            ],
        ];
        // ------------------------------------------------------
        # 質問グループの保存
        $question_group = new  \App\Models\SurveyQuestionsGroup([ 'title' => $title ]);
        $question_group->save();

        # 質問項目の保存
        foreach ($datalist as $data)
        {
            $question = new \App\Models\SurveyQuestion([
                'survey_questions_group_id' => $question_group->id,
                'survey_input_type_id' =>
                 \App\Models\SurveyInputType::where('input_name',$data['input_name'])->first()->id,
                'text' => $data['text'],
                'placeholder' => $data['placeholder'],
                'required' => $data['required'],
                'input_text' => $data['input_text'],
            ]);
            $question->save();


            // 質問項目の選択肢を保存
            if($data['items'])
            {
                foreach ($data['items'] as $value)
                {
                    $question_item = new \App\Models\SurveyQuestionItem([
                        'survey_question_id' => $question->id,
                        'value' => $value,
                    ]);
                    $question_item->save();
                }

            } //end if

        } //end foreach[$datalist]
    }
}
