<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * =================================
 *  問題グループ QuestionGroups
 * =================================
*/
class CreateQuestionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title',150 )->comment('問題タイトル');
            $table->string('resume',150)->comment('問題の説明文')->nullable();
            $table->string('image',150 )->comment('サムネイル画像パス')->nullable()->default(null);
            $table->string('tags',150  )->comment('タグ')->nullable()->default(null);
            $table->time('time_limit'  )->comment('制限時間')->nullable()->default(null);
            $table->dateTime('published_at'    )->comment('公開日')->nullable()->default(null);
            $table->boolean('limited_published')->comment('限定公開か否か')->default(0);
            $table->string('key',150  )->comment('認証キー');

            $table->integer('accessed_count' )->comment('アクセス数')->default(0);
            $table->integer('evaluation_points')->comment('評価ポイント')->default(0);
            $table->integer('average_score'  )->comment('平均点')->default(0);


            $table->unsignedBigInteger('user_id')->comment('問題作成者ID');
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
        Schema::dropIfExists('question_groups');
    }
}
