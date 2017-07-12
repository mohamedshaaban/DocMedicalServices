<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ServiceFiles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('service_id')->unsigned();
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('Services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
