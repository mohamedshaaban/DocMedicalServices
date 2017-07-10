<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VendorBranches', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('vendor_id')->unsigned();
            $table->text('address');
            $table->text('lon');
            $table->text('lat');
            $table->foreign('vendor_id')->references('id')->on('Vendor');
            
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
