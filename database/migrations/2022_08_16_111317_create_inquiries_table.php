<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  お問い合わせ
 * ===============================
 */
class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('問題作成者ID');
            $table->foreign('user_id')->references('id')->on('users') //存在しないidの登録は不可
            ->onDelete('cascade');//主テーブルに関連する従テーブルのレコードを削除

            $table->string('gest_name',150 )->comment('名前')->nullable()->default(null);
            $table->string('gest_email',150)->comment('メールアドレス')->nullable()->default(null);
            $table->string('body',150      )->comment('本文');
            $table->boolean('responded')->comment('対応済みか否か')->default(0);

            $table->timestamps();
            // 'user_id','gest_name','gest_email','body',
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
}
