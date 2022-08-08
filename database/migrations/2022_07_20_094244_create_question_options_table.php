<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * =================================
 *  問題の選択肢 QuestionOptions
 * =================================
*/
class CreateQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->string('answer_text',150)->comment('選択肢のテキスト');
            $table->boolean('answer_boolean')->comment('正解か否か')->default(0);

            $table->unsignedBigInteger('question_id')->comment('問題ID');
            $table->foreign('question_id')->references('id')->on('questions') //存在しないidの登録は不可
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
        Schema::dropIfExists('question_options');
    }
}
