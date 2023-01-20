<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
 * =============================================
 *  *  [ アンケート調査( 質問項目 ) ]　Migration
 * =============================================
 */
class CreateSurveyQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->string('text',100       )->comment('質問内容');
            $table->string('input_text',100 )->comment('入力テキスト')->nullable()->default(null);
            $table->string('placeholder',150)->comment('補足'        )->nullable()->default(null);
            $table->boolean('required'      )->comment('入力必須か否か')->default(0);

            $table->timestamps();

            // 質問内容登録用の入力フォームの種類
            $table->unsignedBigInteger('survey_input_type_id')->comment('入力フォームの種類ID');
            $table->foreign('survey_input_type_id')
            ->references('id')->on('survey_input_types') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            // 質問グループテーブルとの紐づけ
            $table->unsignedBigInteger('survey_questions_group_id')->nullable()->comment('質問グループテーブルの種類ID');
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
        Schema::dropIfExists('survey_questions');
    }
}
