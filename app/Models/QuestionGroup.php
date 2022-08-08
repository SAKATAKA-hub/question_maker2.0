<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
/**
 * ===============================
 *  問題グループ QuestionGroup
 * ===============================
 */
class QuestionGroup extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'title','resume','image','tags','time_limit','published_at','user_id',
        'accessed_count','favorites_count','average_score','max_score','average_elapsed_time',
    ];


    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
    # Questionテーブルとのリレーション ※カラムoderの番号順
    public function questions()
    {
        return $this->hasMany(Question::class,'question_group_id')->orderBy('order','asc');
    }




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * 画像パス（画像無し対応） $question_group->image_puth
         * @return String
        */
        public function getImagePuthAttribute(){

            //画像無し時の画像パス
            $no_image = 'site/image/no_image.png';

            return Storage::exists( $this->image ) ? $this->image : $no_image;
        }

        /**
         * 全体の最大更新日時 $question_group->max_updated_at
         * @return String
        */
        public function getMaxUpdatedAtAttribute(){

            $updates_array = [];

            //1 基本情報の更新日
            $update_question_group_at = $this->updated_at;
            $updates_array[] = \Carbon\Carbon::parse( $update_question_group_at )->format('Y-m-d H:i:s');

            //2 問題の最大更新日時
            $update_questions_at =  $this->questions->max('updated_at');
            $updates_array[] = \Carbon\Carbon::parse( $update_questions_at )->format('Y-m-d H:i:s');

            //3 各問題の解答選択肢の最大更新日時
            foreach ($this->questions as $question)
            {
                $update_options_at = $question->question_options->max('updated_at');
                $updates_array[] = \Carbon\Carbon::parse( $update_options_at )->format('Y-m-d H:i:s');
            }

            return max( $updates_array );
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
     * @param  String $keywords
     * @return Object $query
    */
    public function scopeSearch( $query, $keywords )
    {
        # キーワード文字列を配列へ変換
        $keywords_array = explode( ' ', $keywords );
        // dd($keywords_array);


        # titleから検索
        $query->where(function($query) use( $keywords_array ){
            foreach ($keywords_array as $keyword)
            {
                $query->where('title','like','%'.$keyword.'%');
            }
        });



        # resumeから検索
        $query->orWhere(function($query) use( $keywords_array ){
            foreach ($keywords_array as $keyword)
            {
                $query->where('resume','like','%'.$keyword.'%');
            }
        });


        # tagsから検索
        $query->orWhere(function($query) use( $keywords_array ){
            foreach ($keywords_array as $keyword)
            {
                $query->where('tags','like','%'.$keyword.'%');
            }
        });

        # 問題文($question->text)から検索

            // キーワードを含む問題文を検索
            $questions = \App\Models\Question::search( $keywords )->get();

            // キーワードを含む問題文の問題グループを抽出
            $query->orWhere(function($query) use( $questions ){
                foreach ($questions as $num => $question)
                {
                    if( !$num ){
                        $query->where( 'id', $question->question_group_id );
                    }else{
                        $query->orWhere( 'id', $question->question_group_id );
                    }
                }
            });

        //

        return $query;
    }

    //
}
