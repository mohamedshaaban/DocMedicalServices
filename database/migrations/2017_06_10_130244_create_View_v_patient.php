<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateViewVPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::Statement("Create View v_patient
                        As
                        Select pd.id  as PatientCode
                          , name as PatientName
                          , gender PatientGender
                          , pd.email
                          , GROUP_CONCAT(trim(Concat(pp.country_code,'-',pp.phone))) Phones
                          , GROUP_CONCAT(trim(address)) Addresses
                          , GROUP_CONCAT(CONCAT('(',latitude,',',longitude,')')) MapAddresses
                        from   patient pd left join patient_phone  pp
                        on (pd.id=pp.patient_id)
                        left join patient_addresses pa
                        on (pd.id=pa.patient_id)
                        GROUP BY pd.id,name,gender,email;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::Statement("drop view v_patient");
    }
}
