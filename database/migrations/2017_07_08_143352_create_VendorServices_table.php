<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VendorServices', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('vendor_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->foreign('vendor_id')->references('id')->on('Vendor');
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
