<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
    
    
        Schema::create('VendorUploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_files_id')->unsigned();
            $table->text('file');
            $table->integer('vendorservices_id')->unsigned();
            $table->boolean('is_approved');
            
            $table->foreign('service_files_id')->references('id')->on('ServiceFiles');
            $table->foreign('vendorservices_id')->references('id')->on('VendorServices');
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
