<?php

namespace App\Http\Controllers;

use App\Center;
use App\CenterResponse;
use App\RadiologyType;
use App\RadiologyTypeCategory;
use Illuminate\Http\Request;
use App\PatientRequest;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class PatientRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::Select('id','name')->get();
        $radiologyTypesCategory = RadiologyTypeCategory::all();
        $radiologyTypes = RadiologyType::Select('id','en_name','type_group_id')->get()->toJson();
        $query = "
                    Select * from v_patientrequest
                    where status is NULL 
                 ";
        $requests = collect(DB::select($query));
        return view('patientrequests.index',compact('requests' , 'centers' ,'radiologyTypesCategory' , 'radiologyTypes'));
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
       // dd($request->input());
        $this->validate($request,[
            'requestno'=> 'required',
            'is_at_home'=>'bail|required',
            'status'=>'bail|required',
            'estdeiverydate'=>'bail|required',
            'radio'=>'bail|required'
        ]);

        $dbSuccsess = false;
        $error = 'Unknown error - Store';

        $radio = $request['radio'];       //radio['centers'] center+date in response_center

        $centerResponse_data = [];

        DB::beginTransaction();
        
        try{
            if($request->is_at_home == 0)
            {
                $centerResponse_data['is_at_home'] = $request->is_at_home;
                $centerResponse_data['request_id'] = $request->requestno;
                $centerResponse_data['delivery_est_datetime'] = $request->estdeiverydate;

                $centerResponse = CenterResponse::Create($centerResponse_data);

                foreach($radio as $item)
                {
                    $radio_items['price'] = $item['price'];
                    $radio_items['definition'] = $item['definitions'];
                    $radio_items['preparation'] = $item['preparation'];
                    $radio_items['notes'] = $item['notes'];

                    $radiologyType = RadiologyType::find($item['radiology']);
                    $radiologyType->center_responses()->attach(['response_id'=>$centerResponse->id],$radio_items);
                }

                $centers = $request['centers'];

                foreach($centers as $centerItem)
                {
                    $center = Center::find($centerItem['center']);
                    $center->responses()->attach(['response_id'=>$centerResponse->id],['arrive_datetime'=>$centerItem['date']]);
                }

            }else{

                $centerResponse_data['is_at_home'] = $request->is_at_home;
                $centerResponse_data['request_id'] = $request->requestno;
                $centerResponse_data['delivery_est_datetime'] = str_replace(' ', 'T',$request->estdeiverydate);
                $centerResponse_data['radiology_datetime'] = str_replace(' ', 'T',$request->deliverydate);

                $centerResponse = CenterResponse::Create($centerResponse_data);
            }
            
            $patient_request = PatientRequest::Where('id','=',$request->requestno)->first();
            $patient_request->update(['status'=>$request->status]);

            $dbSuccsess = true;
        }catch (Exception $ex)
        {
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
        $query = "select * from V_PatientRequest 
                  where RequestNo = ".$id;

        $request = collect(DB::select($query));
        return view('patientrequests.edit',compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    public function updateRefuse(Request $request)
    {
        $dbSuccsess = false;
        $error = 'Unkown Error - UpdateRefuse';

        DB::beginTransaction();
            try{
                    $patientrequest = PatientRequest::find($request->requestno);
                    $patientrequest->update(['status'=>$request->status,'refuse_comment'=>$request->refuse_comment]);

                    $dbSuccsess = true;
            }catch(Exception $ex)
            {
                $error = $ex->getMessage();
            }
            finally{
                if($dbSuccsess)
                {
                    DB::commit();
                    return redirect()->back()->with( 'db' , $dbSuccsess);
                }
                else{
                    DB::rollback();
                    return redirect()->back()->with('db' , $dbSuccsess , $error);
                }
        }
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
