<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
 * =========================================
 *  [ アンケート調査( 回答内容 ) ]　Migration
 * =========================================
 */
class CreateSurveyAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->string('value',150)->comment('質問の回答')->nullable()->default(null);
            $table->timestamps();


            // 回答グループテーブルとの紐づけ
            $table->unsignedBigInteger('survey_answers_group_id')->comment('回答グループID');
            $table->foreign('survey_answers_group_id')
            ->references('id')->on('survey_answers_groups') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            // アンケートの質問テーブルとの紐づけ
            $table->unsignedBigInteger('survey_question_id')->comment('質問ID');
            $table->foreign('survey_question_id')
            ->references('id')->on('survey_questions') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_answers');
    }
}
