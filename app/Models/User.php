<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'profile',
        'error_count',
        'key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];





    /*
    |--------------------------------------------------------------------------
    | リレーション
    |--------------------------------------------------------------------------
    */
        # KeepQuestionGroupとのリレーション
        public function keep_question_groups(){
            return $this->hasMany(KeepQuestionGroup::class)
            ->orderBy('created_at','desc');
        }

        # AnswerGroupとのリレーション
        public function answer_groups(){
            return $this->hasMany(AnswerGroup::class)
            ->orderBy('created_at','desc');
        }

        # KeepCreatorUserとのリレーション(フォロー)
        public function keep_creater_users(){
            return $this->hasMany(KeepCreatorUser::class)
            ->where('keep',1)
            ->orderBy('created_at','desc');
        }

        # KeepCreatorUserとのリレーション(フォロワー)
        public function kept_users(){
            return $this->hasMany(KeepCreatorUser::class,'creater_user_id')
            ->where('keep',1)
            ->orderBy('created_at','desc');
        }

        # MailSettingとのリレーション(メール設定)
        public function mail_setting(){
            return $this->hasOne(MailSetting::class);
        }





    /*
    |--------------------------------------------------------------------------
    | アクセサー
    |--------------------------------------------------------------------------
    |
    |
    */
        /**
         * 公開中の問題集一覧 ($user->public_question_groups)
         * @return Array
        */
        public function getPublicQuestionGroupsAttribute(){

            return \App\Models\QuestionGroup::where('user_id',$this->id)
            ->where('published_at', '<>', null) //非公開は除く
            ->orderBy('published_at','desc')
            ->get();
        }


        /**
         * いいねした問題集一覧 ($user->like_question_groups)
         * @return Array
        */
        public function getLikeQuestionGroupsAttribute(){

            # KeepQuestionGroupとのリレーション
            $keeps = $this->keep_question_groups;

            # リターンデータの作成
            $likes = [];
            foreach ($keeps as $keep) {
                $likes[] = QuestionGroup::find( $keep->question_group_id );
            }
            return $likes;
        }


        /**
         * フォローしたクリエーター一覧 ($user->follow_creators)
         * @return Array
        */
        public function getFollowCreatorsAttribute(){

            # KeepCreatorUserとのリレーション(フォロー)
            $keeps = $this->keep_creater_users;

            # リターンデータの作成
            $likes = [];
            foreach ($keeps as $keep) {
                $likes[] = User::find( $keep->creater_user_id );
            }
            return $likes;
        }


        /**
         * フォロワー一覧 ($user->follower_users)
         * @return Array
        */
        public function getFollowerUsersAttribute(){

            # KeepCreatorUserとのリレーション(フォロー)
            $keeps = $this->kept_users;

            # リターンデータの作成
            $likes = [];
            foreach ($keeps as $keep) {
                $likes[] = User::find( $keep->user_id );
            }
            return $likes;
        }


        /**
         * ユーザーが受験した平均点 ($user->average_score)
         * @return Integer
        */
        public function getAverageScoreAttribute(){

            // ユーザーが受検した合計点 / ユーザーの受検数
            $average_score = $this->answer_groups->sum('score') / count( $this->answer_groups);
            return round( $average_score, 1 );
        }

        /**
         * ユーザーが受験した合計時間 ($user->answer_groups_total_time)
         * @return Array
        */
        public function getAnswerGroupsTotalTimeAttribute(){

            $time_text = '';
            $h=0; $m=0; $s=0;
            foreach ($this->answer_groups as $answer_group) {
                $time_text = str_replace( '秒', '', $answer_group->elapsed_time );
                $time_text = str_replace(['時間','分'],':',$time_text);
                $time_array = explode(':',$time_text);

                $h += $time_array[0];
                $m += $time_array[1];
                $s += $time_array[2];
            }

            //繰り上がり計算
            $add_m = round( $s/60 );
            $s = $s % 60;

            $m += $add_m;
            $add_h =round( $m/60 );
            $m = $m % 60;

            $h += $add_h;


            return sprintf('%02d時間%02d分%02d秒',$h,$m,$s);
        }


        /**
         * 画像パス[画像無し対応] ($user->image_puth)
         * @return String
        */
        public function getImagePuthAttribute()
        {

            //画像無し時の画像パス
            $no_image = 'site/image/user_no_image.png';

            return Storage::exists( $this->image ) ? $this->image : $no_image;
        }


        /**
         * ストレージ保存された文章（自己紹介） $user->profile_text
         * @return String
         */
        public function getProfileTextAttribute()
        {
            // パスから改行を取り除く
            $text = $this->profile;
            $path = str_replace(["\r\n", "\r", "\n", "\t","\v"], '', $text);

            return \Illuminate\Support\Facades\Storage::exists($path) ?
            \Illuminate\Support\Facades\Storage::get($path) : $text;
        }
    /*
    |--------------------------------------------------------------------------
    | memo
    |--------------------------------------------------------------------------

        # ユーザー公開中の問題数
        {{ $user->public_question_groups->count()> }}

        # ユーザーがイイネした問題数
        {{ count( $user->like_question_groups ) }}

        # ユーザーのフォロー数
        {{ count( $user->follow_creators ) }}

        # ユーザーのフォロアー数
        {{ count( $user->follower_users ) }}

        # ユーザーの受検問題集数
        {{ count( $user->answer_groups ) }}

        # ユーザーが受検した合計点
        {{ $user->answer_groups->sum('score') }}

        # ユーザーの合計受検時間'elapsed_time'

    */

}
