<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorItemBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('VendorItemBranches', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('vendor_item_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->decimal('price');
            $table->text('description');
            $table->boolean('is_active');
            $table->timestamps();
            $table->foreign('vendor_item_id')->references('id')->on('VendorItems');
            $table->foreign('branch_id')->references('id')->on('VendorBranches');
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
