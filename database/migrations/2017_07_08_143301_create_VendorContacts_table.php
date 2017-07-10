<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VendorContacts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('title');
            $table->text('description');
            $table->text('level');
            $table->text('phone');
            $table->text('mobile');
            $table->text('ex');
            $table->integer('vendor_branch_id')->unsigned();
            
            
$table->foreign('vendor_branch_id')->references('id')->on('VendorBranches');
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
