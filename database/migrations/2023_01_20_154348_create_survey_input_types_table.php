<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
 * =================================================================
 *  [ アンケート調査( 質問内容登録用の入力フォームの種類 ) ]　Migration
 * =================================================================
 **/
class CreateSurveyInputTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_input_types', function (Blueprint $table) {
            $table->id();
            $table->integer('code'         )->comment('入力フォームコード番号');
            $table->string('input_text',100)->comment('表示用の名前');
            $table->string('input_name',100)->comment('登録用の名前');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_input_types');
    }
}
