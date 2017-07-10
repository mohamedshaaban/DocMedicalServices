<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_url', function (Blueprint $table) {
            $table->integer('user_type_id')->unsigned();
            $table->integer('url_id')->unsigned();
            $table->timestamps();
            $table->foreign('url_id')->references('id')->on('urls');
            $table->foreign('user_type_id')->references('id')->on('user_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_type_url', function (Blueprint $table) {
            Schema::dropIfExists('user_type_url');
        });
    }
}
