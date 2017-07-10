<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class CreateViewVPatientanswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::Statement("Create View v_patientanswers
                        As
                        select a.request_id RequestNo
                             , q.en_name    EnQusestion
                             , a.answer     QuestionAnswerBool
                             , Case When a.answer = 0 then 'No'
                                    else 'Yes'
                               end  QuestionAnswerStr
                        from request_answers a left join radiology_questions q
                        on (a.question_id=q.id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop View V_PatientAnswers");
    }
}
