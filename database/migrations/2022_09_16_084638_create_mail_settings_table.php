<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  メールの受信設定
 * ===============================
 */
class CreateMailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('keep_question_group')->comment('いいね')->default(1);
            $table->boolean('keep_creator_user'  )->comment('フォロー')->default(1);
            $table->boolean('comment'            )->comment('コメント')->default(1);
            $table->boolean('infomation'         )->comment('運営会社からのお知らせ')->default(1);

            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_settings');
    }
}
