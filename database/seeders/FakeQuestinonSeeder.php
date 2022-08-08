<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FakeQuestinonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # ユーザー情報
        $user = \App\Models\User::first();

        // # 問題集の登録
        // $question_group = new \App\Models\QuestionGroup([
        //     'user_id' => $user->id,
        //     'title'   => 'テスト問題',
        //     'resume'  => 'この問題は、作業用のテスト問題です。',
        //     'image'   => 'site/image/sample.jpg',
        //     'tags'    => '仮登録問題　テスト　hoge',
        //     'time_limit' => '00:01:00',
        //     'published_at' => \Carbon\Carbon::parse()->format('Y-m-d H:i:s'),
        // ]);
        // $question_group->save();


        # 問題の作成
        $questions_data = [
            [
                'text' => '写真の昆虫の名前を、ひらがな6文字で答えよ。',
                'answer_type' => 0,
                'order' => 1,
                'image' => 'site/image/sample1.jpeg',
                'options' => [
                    [ 'answer_text' => 'てんとうむし','answer_boolean' => 1, ],
                ],
            ],
            [
                'text' => '写真の色えんぴつの本数を選択せよ。',
                'answer_type' => 1,
                'order' => 2,
                'image' => 'site/image/sample2.jpeg',
                'options' => [
                    [ 'answer_text' => '10本','answer_boolean' => 0, ],
                    [ 'answer_text' => '21本','answer_boolean' => 1, ],
                    [ 'answer_text' => '50本','answer_boolean' => 0, ],
                    [ 'answer_text' => '100本','answer_boolean' => 0, ],
                ],
            ],
            [
                'text' => '写真に写っているものの名前のみを全て選択せよ。',
                'answer_type' => 2,
                'order' => 3,
                'image' => 'site/image/sample3.jpeg',
                'options' => [
                    [ 'answer_text' => 'ノートパソコン','answer_boolean' => 1, ],
                    [ 'answer_text' => 'コーヒー','answer_boolean' => 1, ],
                    [ 'answer_text' => '冷蔵庫','answer_boolean' => 0, ],
                    [ 'answer_text' => '洗濯機','answer_boolean' => 0, ],
                ],
            ],

        ];



        # 問題集の登録
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title'   => 'テスト問題1',
            'resume'  => 'この問題は、作業用のテスト問題です。',
            'image'   => 'site/image/sample.jpg',
            'tags'    => '仮登録問題　テスト　hoge',
            'time_limit' => '00:01:00',
            'published_at' => \Carbon\Carbon::parse()->format('Y-m-d H:i:s'),
        ]);
        $question_group->save();
        foreach ($questions_data as $question_data)
        {
            # 問題情報の保存
            $question = new \App\Models\Question([
                'question_group_id' => $question_group->id,
                'text'        => $question_data['text'],
                'answer_type' => $question_data['answer_type'],
                'order'       => $question_data['order'],
                'image'       => $question_data['image'],
            ]);
            $question->save();


            # 問題の回答選択肢情報の保存
            foreach ( $question_data['options'] as $option_data)
            {
                $question_option = new \App\Models\QuestionOption([
                    'question_id'    => $question->id,
                    'answer_text'    => $option_data['answer_text'],
                    'answer_boolean' => $option_data['answer_boolean'],
                ]);
                $question_option->save();
            }
        }


        # 問題集の登録
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title'   => 'テスト問題2',
            'resume'  => 'この問題は、作業用のテスト問題です。',
            'image'   => 'site/image/sample.jpg',
            'tags'    => '仮登録問題　テスト　hoge',
            'time_limit' => '00:01:00',
            'published_at' => \Carbon\Carbon::parse()->format('Y-m-d H:i:s'),
        ]);
        $question_group->save();
        foreach ($questions_data as $question_data)
        {
            # 問題情報の保存
            $question = new \App\Models\Question([
                'question_group_id' => $question_group->id,
                'text'        => $question_data['text'],
                'answer_type' => $question_data['answer_type'],
                'order'       => $question_data['order'],
                'image'       => $question_data['image'],
            ]);
            $question->save();


            # 問題の回答選択肢情報の保存
            foreach ( $question_data['options'] as $option_data)
            {
                $question_option = new \App\Models\QuestionOption([
                    'question_id'    => $question->id,
                    'answer_text'    => $option_data['answer_text'],
                    'answer_boolean' => $option_data['answer_boolean'],
                ]);
                $question_option->save();
            }
        }

        # 問題集の登録
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title'   => 'テスト問題3',
            'resume'  => 'この問題は、作業用のテスト問題です。',
            'image'   => 'site/image/sample.jpg',
            'tags'    => '仮登録問題　テスト　hoge',
            'time_limit' => '00:01:00',
            'published_at' => \Carbon\Carbon::parse()->format('Y-m-d H:i:s'),
        ]);
        $question_group->save();
        foreach ($questions_data as $question_data)
        {
            # 問題情報の保存
            $question = new \App\Models\Question([
                'question_group_id' => $question_group->id,
                'text'        => $question_data['text'],
                'answer_type' => $question_data['answer_type'],
                'order'       => $question_data['order'],
                'image'       => $question_data['image'],
            ]);
            $question->save();


            # 問題の回答選択肢情報の保存
            foreach ( $question_data['options'] as $option_data)
            {
                $question_option = new \App\Models\QuestionOption([
                    'question_id'    => $question->id,
                    'answer_text'    => $option_data['answer_text'],
                    'answer_boolean' => $option_data['answer_boolean'],
                ]);
                $question_option->save();
            }
        }


        # 問題集の登録
        $question_group = new \App\Models\QuestionGroup([
            'user_id' => $user->id,
            'title'   => 'テスト問題4 非公開',
            'resume'  => 'この問題は、作業用のテスト問題です。',
            'image'   => 'site/image/sample.jpg',
            'tags'    => '仮登録問題　テスト　hoge',
            'time_limit' => '00:01:00',
        ]);
        $question_group->save();
        foreach ($questions_data as $question_data)
        {
            # 問題情報の保存
            $question = new \App\Models\Question([
                'question_group_id' => $question_group->id,
                'text'        => $question_data['text'],
                'answer_type' => $question_data['answer_type'],
                'order'       => $question_data['order'],
                'image'       => $question_data['image'],
            ]);
            $question->save();


            # 問題の回答選択肢情報の保存
            foreach ( $question_data['options'] as $option_data)
            {
                $question_option = new \App\Models\QuestionOption([
                    'question_id'    => $question->id,
                    'answer_text'    => $option_data['answer_text'],
                    'answer_boolean' => $option_data['answer_boolean'],
                ]);
                $question_option->save();
            }
        }

    }
}
