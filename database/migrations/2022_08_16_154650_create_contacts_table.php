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
            $table->string('name',150     )->comment('名前');
            $table->string('email',150    )->comment('メールアドレス');
            $table->string('body',150     )->comment('本文');
            $table->string('type_text',150)->comment('お問い合わせの種類')->nullable()->default(null);

            $table->boolean('responsed')->comment('対応済みか否か')->default(0);
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
