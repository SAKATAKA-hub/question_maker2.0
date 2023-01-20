<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
 * =============================================
 *  *  [ アンケート調査( 質問グループ ) ]　Migration
 * =============================================
 */
class CreateSurveyQuestionsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_questions_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title',100     )->comment('質問グループタイトル');
            $table->string('access_key',150)->comment('アクセスキー')->nullable()->default(null);
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
        Schema::dropIfExists('survey_questions_groups');
    }
}
