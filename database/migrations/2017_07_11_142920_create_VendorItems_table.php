<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VendorItems', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ar_name');
            $table->text('en_name');
            $table->integer('vendor_service_type_id')->unsigned();
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamps();
            $table->foreign('vendor_service_type_id')->references('id')->on('VendorServicesTypes');
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
