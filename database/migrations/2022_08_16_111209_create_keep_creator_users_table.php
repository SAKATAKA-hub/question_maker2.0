<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  クリエーターのキープ
 * ===============================
 */
class CreateKeepCreatorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keep_creator_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('問題作成者ID');
            $table->foreign('user_id')->references('id')->on('users') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->integer('creater_user_id')->comment('回答の種類');
            $table->boolean('keep')->comment('キープ中か否か')->default(1);
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
        Schema::dropIfExists('keep_creator_users');
    }
}
