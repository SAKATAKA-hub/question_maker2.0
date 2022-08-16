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
            $table->integer('user_id'      )->comment('ユーザーID'    );
            $table->string('gest_name',150 )->comment('名前'          )->nullable()->default(null);
            $table->string('gest_email',150)->comment('メールアドレス')->nullable()->default(null);

            $table->unsignedBigInteger('question_group_id')->comment('問題グループID');
            $table->foreign('question_group_id')->references('id')->on('question_groups') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->string('body',150)->comment('本文');
            $table->boolean('read'   )->comment('既読か否か')->default(0);
            $table->timestamps();
            // 'user_id','question_group_id','body','read',
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
