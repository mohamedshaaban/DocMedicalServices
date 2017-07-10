<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->string('patient_name');
            $table->integer('patient_age')->unsigned();
            $table->decimal('patient_weight');
            $table->integer('patient_address_id')->nullable();
            $table->boolean('is_at_home');
            $table->boolean('is_able_to_be_stable');
            $table->integer('number_of_scanned_prescriptions')->unsigned();
            $table->timestampsTz();
            $table->foreign('patient_id')->references('id')->on('patient');
            $table->foreign('patient_address_id')->references('id')->on('patient_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_requests');
    }
}
