<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
 * =========================================
 *  *  [ アンケート調査( 質問項目の選択肢 ) ]　Migration
 * =========================================
 */
class CreateSurveyQuestionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_question_items', function (Blueprint $table) {
            $table->id();
            $table->string('value',100)->comment('質問の選択肢');
            $table->timestamps();

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
        Schema::dropIfExists('survey_question_items');
    }
}
