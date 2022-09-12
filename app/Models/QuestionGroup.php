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
        'accessed_count',    //'アクセス数'
        'evaluation_points', //'評価ポイント'
        'average_score',     //'平均点'
    ];


    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # Userテーブルとのリレーション
        public function user()
        {
            return $this->belongsTo(User::class,'user_id');
        }

        # Questionテーブルとのリレーション ※カラムoderの番号順
        public function questions()
        {
            return $this->hasMany(Question::class)->orderBy('order','asc');
        }

        # AnswerGroupsテーブルとのリレーション
        public function answer_groups()
        {
            return $this->hasMany(AnswerGroup::class,'question_group_id');
        }

        # KeepQuestionGroupテーブルとのリレーション
        public function keep_question_groups()
        {
            return $this->hasMany(KeepQuestionGroup::class,'question_group_id');
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
         * 公開日のテキスト表示 $question_group->befor_datetime_text
         * ○○日前（時間前）
         * @return String
        */
        public function getBeforDatetimeTextAttribute(){

            $now = new \Carbon\Carbon('now');
            $datetime = new \Carbon\Carbon( $this->published_at );

            $datetime_array = [
                ['num'=>$datetime->diffInSeconds( $now ), 'text'=>'秒前',],
                ['num'=>$datetime->diffInMinutes( $now ), 'text'=>'分前',],
                ['num'=>$datetime->diffInHours( $now ),   'text'=>'時間前',],
                ['num'=>$datetime->diffInDays( $now ),    'text'=>'日前',],
                ['num'=>$datetime->diffInMonths( $now ),  'text'=>'ヶ月前',],
                ['num'=>$datetime->diffInYears( $now ),   'text'=>'年前',],
            ];

            $text = '';
            foreach ($datetime_array as $value) {
                $text = $value['num'] ? $value['num'].$value['text'] : $text;
            }


            return $text;
        }

        /**
         * 問題数 $question_group->question_count
         * @return String
        */
        public function getQuestionCountAttribute(){
            return $this->hasMany(Question::class)->count();
        }


        /**
         * 制限時間のテキスト表記 $question_group->time_limit_text
         * @return String
        */
        public function getTimeLimitTextAttribute(){

            $array = explode(':',$this->time_limit);

            $text = '';
            $text .= ($array[0]!='00') ? sprintf('%d',$array[0]).'時間' : '';
            $text .= ($array[1]!='00') ? sprintf('%d',$array[1]).'分' : '';
            $text .= ($array[2]!='00') ? sprintf('%d',$array[2]).'秒' : '';
            $text = ($text=='') ? 'なし' : $text;

            return $text;
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


        /**
         * 平均点 $question_group->average_score
         * @return String
        */
        public function getAverageScoreAttribute(){

            $total_score = $this->answer_groups->sum('score'); //合計点
            $count = $this->answer_groups->count(); //受検者数

            // 受検者数0のときは、'---'を表示、それ以外は'平均点'を表示
            return  $count ? round( $total_score / $count , 1 ) : '---';
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
