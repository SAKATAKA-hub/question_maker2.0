<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/**
 * ===============================
 *  お問い合わせ
 * ===============================
 */
class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'      )->comment('ユーザーID'    );
            $table->string('gest_name',150 )->comment('名前'          )->nullable()->default(null);
            $table->string('gest_email',150)->comment('メールアドレス')->nullable()->default(null);
            $table->string('body',150      )->comment('本文');
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
        Schema::dropIfExists('contacts');
    }
}
