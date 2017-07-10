<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateViewVPatientrequestuploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("Create view v_patientrequestuploads 
                       As
                        Select request_id , GROUP_CONCAT(trim(Concat(image_url))) PrescriptionImages
                        from   patient_uploads
                        GROUP BY request_id;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::statement("drop view V_Patientrequestuploads;");
    }
}
