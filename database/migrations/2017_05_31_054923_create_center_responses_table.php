<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('delivery_est_datetime');
            $table->integer('request_id')->unsigned();
            $table->timestamp('radiology_datetime')->nullable();
            $table->boolean('is_at_home');
            $table->timestamps();
            $table->foreign('request_id')->references('id')->on('patient_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_responses');
    }
}
