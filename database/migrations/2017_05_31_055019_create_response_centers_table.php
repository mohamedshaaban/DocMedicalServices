<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_centers', function (Blueprint $table) {
            $table->integer('center_id')->unsigned();
            $table->integer('response_id')->unsigned();
            $table->timestamp('arrive_datetime');
            $table->timestamps();
            $table->foreign('center_id')->references('id')->on('centers');
            $table->foreign('response_id')->references('id')->on('center_responses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('response_centers');
    }
}
