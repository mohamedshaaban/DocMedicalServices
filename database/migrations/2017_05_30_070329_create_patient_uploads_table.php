<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_url');
            $table->integer('request_id')->unsigned();
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
        Schema::dropIfExists('patient_uploads');
    }
}
