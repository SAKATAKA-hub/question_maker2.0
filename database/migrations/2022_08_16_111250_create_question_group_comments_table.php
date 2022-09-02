<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  問題集へのコメント
 * ===============================
 */
class CreateQuestionGroupCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_group_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'  )->comment('ユーザーID'    );
            $table->string('body',150  )->comment('本文');
            $table->boolean('is_hidden')->comment('非表示か否か')->default(0);
            $table->timestamps();

            $table->unsignedBigInteger('question_group_id')->comment('問題グループID');
            $table->foreign('question_group_id')->references('id')->on('question_groups') //存在しないidの登録は不可
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
        Schema::dropIfExists('question_group_comments');
    }
}
