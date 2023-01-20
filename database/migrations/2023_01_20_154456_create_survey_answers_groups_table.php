<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
 * ======================================
 *  [ アンケート調査( 回答グループ ) ]　Migration
 * ======================================
 */
class CreateSurveyAnswersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_answers_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title',150     )->comment('質問のタイトル')->nullable()->default(null);
            $table->string('respondent',150)->comment('送信者')->nullable()->default(null);
            $table->string('company',150   )->comment('企業名')->nullable()->default(null);
            $table->timestamps();


            // 質問グループテーブルとの紐づけ
            $table->unsignedBigInteger('survey_questions_group_id')->comment('質問グループID')->nullable()->comment('質問ID');
            $table->foreign('survey_questions_group_id')
            ->references('id')->on('survey_questions_groups') //存在しないidの登録は不可
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
        Schema::dropIfExists('survey_answers_groups');
    }
}
