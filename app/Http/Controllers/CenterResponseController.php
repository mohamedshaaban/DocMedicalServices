<?php

namespace App\Http\Controllers;

use App\PatientRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CenterResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = "
                    Select * from v_patientrequest 
                    where status = 'qw' 
                 ";
        $requests = collect(DB::select($query));
        return view('centerresponses.index',compact('requests'));

    }

    public function answersAjax(Request $request)
    {
        $requestNo = $request->input('id');
        if ($request->ajax())
        {
            $query = "
                        Select EnQusestion , QuestionAnswerStr , QuestionAnswerBool 
                        from V_PatientAnswers 
                        where RequestNo = $requestNo;
                     ";
            $answers = collect(DB::select($query))->toJson();
            return $answers;
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dbSuccsess = false;
        $error = 'Unknown Error - store';

        $this->validate($request,[
            'requestno'=> 'required',
            'status'=>'bail|required',
        ]);

        DB::beginTransaction();

        try
        {
            $patient_request = PatientRequest::Where('id','=',$request->requestno)->first();
            $patient_request->update(['status'=>$request->status]);
            $dbSuccsess = true;
        }catch(Exception $ex)
        {
            // log error
            $error = $ex->getMessage();
        }finally{
            if($dbSuccsess)
            {
                DB::commit();
                return redirect()->back()
                                 ->with( 'db' , $dbSuccsess);
            }
            else{
                DB::rollback();
                return redirect()->back()
                    ->with( 'db' , $dbSuccsess)
                    ->with( 'error' , $error);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
