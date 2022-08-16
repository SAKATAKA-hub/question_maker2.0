<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  問題集の違反通報
 * ===============================
 */
class CreateQuestionGroupViolationReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_group_violation_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'      )->comment('ユーザーID'    );
            $table->string('gest_name',150 )->comment('名前'          )->nullable()->default(null);
            $table->string('gest_email',150)->comment('メールアドレス')->nullable()->default(null);

            $table->unsignedBigInteger('question_group_id')->comment('問題グループID');
            $table->foreign('question_group_id')->references('id')->on('question_groups') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->string('body',150  )->comment('本文');
            $table->boolean('responded')->comment('対応済みか否か')->default(0);
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
        Schema::dropIfExists('question_group_violation_reports');
    }
}
