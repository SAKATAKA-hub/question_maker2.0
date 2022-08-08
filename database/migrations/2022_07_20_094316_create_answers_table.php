<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * =================================
 *  回答 Answers
 * =================================
*/
class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('text',150)->comment('回答内容');
            $table->boolean('is_correct')->comment('正解か否か')->default(0);

            $table->unsignedBigInteger('answer_group_id')->comment('回答グループID');
            $table->foreign('answer_group_id')->references('id')->on('answer_groups') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

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
        Schema::dropIfExists('answers');
    }
}
