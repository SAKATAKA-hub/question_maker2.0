<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * =================================
 *  問題 Questions
 * =================================
*/
class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text',150    )->comment('問題文');
            $table->integer('answer_type')->comment('回答の種類');
            $table->integer('order'      )->comment('出題順位');
            $table->string('image',150   )->comment('問題画像パス')->nullable()->default(null);
            $table->boolean('random')->comment('解答選択のランダム設定')->default(0);

            $table->string('commentary_text',150 )->comment('解説文')->nullable()->default(null);
            $table->string('commentary_image',150)->comment('解説画像パス')->nullable()->default(null);


            $table->unsignedBigInteger('question_group_id')->comment('問題グループID');
            $table->foreign('question_group_id')->references('id')->on('question_groups') //存在しないidの登録は不可
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
        Schema::dropIfExists('questions');
    }
}
