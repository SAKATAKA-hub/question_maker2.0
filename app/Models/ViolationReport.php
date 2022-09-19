<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * ===============================
 *  問題集の違反通報
 * ===============================
 */
class ViolationReport extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id','question_group_id','body','responsed','violation_report_type_id'
    ];





    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # Userテーブルとのリレーション
        public function user()
        {
            return $this->belongsTo(User::class);
        }


        # Userテーブルとのリレーション
        public function question_group()
        {
            return $this->belongsTo(QuestionGroup::class,'question_group_id');
        }

    /*
    |--------------------------------------------------------------------------
    | スコープ
    |--------------------------------------------------------------------------
    |
    |
    */

        /**
         * 一覧表示用データリスト（data_list)
         * @return Array
        */
        public function scopeDataList( $query )
        {
            # 報告一覧データの取得
            $violation_reports =  $query->orderBy('created_at','desc')->get();

            # データの加工
            $data_list = [];
            for ($i=0; $i < $violation_reports->count(); $i++) {
                $question_group = \App\Models\QuestionGroup::find( $violation_reports[$i]->question_group_id );


                $data = [
                    // 日時
                    'date' => \Carbon\Carbon::parse( $violation_reports[$i]->created_at )->format('Y年m月d日 H:i'),

                    // 報告情報
                    'report'        => $violation_reports[$i],

                    //報告者情報
                    'reported_user' =>$violation_reports[$i]->user,

                    // 問題集情報
                    'question_group' => $question_group,

                    // 作成者情報
                    'creater_user'   => $question_group->user,
                ];
                $data_list[] = $data;
            }


            return $data_list;
        }
    //
}

