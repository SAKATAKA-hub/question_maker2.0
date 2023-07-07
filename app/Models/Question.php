<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
/**
 * ===============================
 *  問題 Questions
 * ===============================
 */
class Question extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'answer_type','order','question_group_id',
        'image', //問題画像
        'text',  //問題文
        'commentary_image', //説明画像
        'commentary_text',  //説明文
        'random'// ランダム設定
    ];




    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # QuestionOptionテーブルとのリレーション
        public function question_options(){
            return $this->hasMany(QuestionOption::class);
        }

        # QuestionGroupテーブルとのリレーション
        public function question_group(){
            return $this->belongsTo(QuestionGroup::class);
        }


    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * 画像パス（画像無し対応） $question->image_puth
         * @return String
        */
        public function getImagePuthAttribute(){

            //画像無し時の画像パス
            $no_image = 'site/image/no_image2.png';

            return Storage::exists( $this->image ) ? $this->image : $no_image;
        }


        /**
         * ストレージ保存された文章（問題文）$question->text_text
         * @return String
         */
        public function getTextTextAttribute()
        {

            $text = $this->text;
            $path = $this->text;

            //余計な記号をを除去
            preg_match_all('/[a-zA-Z0-9\/._-]+/', $path, $matches);
            $path = implode('', $matches[0]);

            // パスから改行を取り除く
            $path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $path);

            return \Illuminate\Support\Facades\Storage::exists($path) ?
            \Illuminate\Support\Facades\Storage::get($path) : $text;
        }


        /**
         * 解説画像パス（画像無し対応） $question->commentary_image_puth
         * @return String
        */
        public function getCommentaryImagePuthAttribute(){

            //画像無し時の画像パス
            $no_image = 'site/image/no_image2.png';


            return Storage::exists( $this->commentary_image ) ? $this->commentary_image : $no_image;
        }


        /**
         * ストレージ保存された文章（解説文）$question->commentary_storage_text
         * @return String
         */
        public function getCommentaryStorageTextAttribute()
        {
            $text = $this->commentary_text;
            $path = $this->commentary_text;

            //余計な記号をを除去
            preg_match_all('/[a-zA-Z0-9\/._-]+/', $path, $matches);
            $path = implode('', $matches[0]);

            // パスから改行を取り除く
            $path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $path);

            return \Illuminate\Support\Facades\Storage::exists($path) ?
            \Illuminate\Support\Facades\Storage::get($path) : $text;
        }


        /**
         * 問題の選択肢（解答用） $question->option_answer_texts
         * @return Array
        */
        public function getOptionAnswerTextsAttribute(){

            //選択肢のオブジェクトを取得
            $question_options =
            QuestionOption::where('question_id', $this->id)->get();

            //選択肢のテキストのみを配列へ保存
            $options_array = [];
            foreach ($question_options as $question_option) {
                $options_array[] = $question_option->answer_text;
            }

            return $options_array;
        }




        /**
         * 問題の選択肢（ランダム解答用） $question->option_random_answer_texts
         * @return Array
        */
        public function getOptionRandomAnswerTextsAttribute(){

            //選択肢のオブジェクトを取得
            $question_options =
            QuestionOption::where('question_id', $this->id)->get();

            //選択肢のテキストのみを配列へ保存
            $options_array = [];
            foreach ($question_options as $question_option) {
                $options_array[] = $question_option->answer_text;
            }

            //選択肢のテキストをランダムに並び替え
            $rand_array = [];
            $count = count($options_array)-1;
            while ($count >= 0) {

                $num = mt_rand( 0, $count );
                $rand_array[] = $options_array[ $num ];
                array_splice( $options_array, $num , 1 );

                $count--;
            }


            return $rand_array;
        }




        /**
         * 問題の正解 $question->answer
         * @return String
        */
        public function getAnswerAttribute(){

            switch ( $this->answer_type ) {
                /* 解答選択肢が複数の時 */
                case 2:
                    $question_options =
                    QuestionOption::where('question_id', $this->id)->where('answer_boolean', 1 )->get();

                    $array = [];
                    foreach ($question_options as $question_option) {
                        $array[] = $question_option->answer_text;
                    }
                    // $answer = implode(' ',$array);
                    $answer = $array;
                    break;

                /* それ以外の時 */
                default:
                    $question_option =
                    QuestionOption::where('question_id', $this->id)->where('answer_boolean', 1 )->first();

                    $answer = $question_option->answer_text;
                    break;
                //
            }

            return $answer;
        }
    //
    /*
    |--------------------------------------------------------------------------
    | スコープ
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * キーワード検索結果のオブジェクトを返す( seach )
         * @param  String $seach_keywords
         * @return Object $query
        */
        public function scopeSearch( $query, $seach_keywords )
        {
            # キーワード文字列を配列へ変換
            $keywords_array = explode( ' ', $seach_keywords );

            # 問題文(text)から検索
            foreach ($keywords_array as $keyword)
            {
                $query->where('text','like','%'.$keyword.'%');
            }

            return $query;
        }




}
