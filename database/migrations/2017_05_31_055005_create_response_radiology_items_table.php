<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseRadiologyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_radiology_items', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
            $table->integer('response_id')->unsigned();
            $table->decimal('price');
            $table->string('definition')->nullable();
            $table->string('preparation')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('radiology_types');
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
        Schema::dropIfExists('response_radiology_items');
    }
}
