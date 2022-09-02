<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集へのコメント
 * ===============================
 */
class QuestionGroupComment extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','question_group_id','body','is_hidden',
    ];




    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    */

        /**
         * 公開日のテキスト表示 $this->befor_datetime_text
         * ○○日前（時間前）
         * @return String
        */
        public function getBeforDatetimeTextAttribute(){

            $now = new \Carbon\Carbon('now');
            $datetime = new \Carbon\Carbon( $this->created_at );

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

    /*
    |--------------------------------------------------------------------------
    | スコープ
    |--------------------------------------------------------------------------
    */

        /**
         * API用のコメントデータを返す(CommentListAPI )
         *
         * @return Object $query
         * @param  String $question_group_id
        */
        public function scopeCommentListAPI( $query, $question_group_id )
        {
            # question_group_idに該当するデータの取得
            $comments = $query->where('question_group_id',$question_group_id)->get();


            # データの取得と加工
            for ($i=0; $i < $comments->count(); $i++) {
                $comment = $comments[ $i ];

                // 投稿時間テキスト
                $comment['posted_at'] = $comment->befor_datetime_text;

                // userデータの取得
                $comment->user = User::find($comment->user_id);
                if($comment->user){
                    $comment->user['image_url'] = asset( 'storage/'.$comment->user->image_puth );
                }

                // データの更新
                $comments[ $i ] = $comment;
            }

            return $comments;
        }
    //

}
