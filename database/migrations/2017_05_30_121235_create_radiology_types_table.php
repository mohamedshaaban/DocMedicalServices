<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadiologyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiology_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text("ar_name");
            $table->text("en_name");
            $table->integer("type_group_id")->unsigned();
            $table->timestamps();
            $table->foreign('type_group_id')->references('id')->on('radiology_type_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radiology_types');
    }
}
