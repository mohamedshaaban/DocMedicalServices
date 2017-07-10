<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateViewVPatientrequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::Statement("Create View v_patientrequest
                        As
                        Select
                          p.*
                          ,patient_age as  Age
                          ,Concat(patient_weight,' KG') as Weight
                          ,is_at_home
                          ,Case When r.is_at_home = 0 then 'At Center'
                           else 'At Home'
                           end Location
                          ,Case When r.is_able_to_be_stable = 0 then 'No'
                           else 'Yes'
                           end Stable
                          ,DATE_FORMAT(r.created_at,'%d-%m-%Y %h:%i %p') as RequestDate
                          ,u.PrescriptionImages  as Uploads
                          ,r.id RequestNo
                          ,r.status
                        from patient_requests r left join V_Patient p
                        on (r.patient_id=p.PatientCode)
                        left join V_Patientrequestuploads u
                        on (r.id=u.request_id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::Statement("drop view V_PatientRequest;");
    }
}
