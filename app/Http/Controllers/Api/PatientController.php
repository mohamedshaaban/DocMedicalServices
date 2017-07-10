<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PatientLogin;
use App\PatientRequest;
use App\PatientUpload;
use \Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function __construct()
    {
    }

    public function patient_request_radiology(Request $request){
        $validator = Validator::make($request->all(),[
            'api_key'=>'required',
            'patient_name'=>'bail|required|alpha',
            'patient_age'=>'bail|required|numeric',
            'patient_weight'=>'bail|required|numeric',
            'patient_address_id'=>'bail|required_if:is_at_home,true',
            'is_at_home'=>'required',
            'is_able_to_be_stable'=>'required',
            'number_of_scanned_prescriptions'=>'bail|required|numeric|min:1'
            ],[
            'patient_address_id.required_if' => 'The :attribute field is required.',
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json([
                'is_successful'=>false,
                'error_message'=>reset($errors)
            ]);
        }
       $login = PatientLogin::where('api_key',$request->input('api_key'))->first();
        if(is_null($login)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Invalid Api Key'
            ]);
        }
        $patient = $login->patient;
        if(is_null($patient)) {
            return response()->json([
                'is_successful' => false,
                'error_message' => 'Can\'t find Patient related to Api Key '. $request->input('api_key')
            ]);
        }
        $patient_request = new PatientRequest($request->only([
            'patient_name',
            'patient_age',
            'patient_weight',
            'patient_address_id',
            'is_at_home',
            'is_able_to_be_stable',
            'number_of_scanned_prescriptions']));
        try{
            $patient->patient_requests()->save($patient_request);
            return response()->json([
                'request_id'=>$patient_request->id,
                'is_successful' => true
            ]);
        }catch (Exception $exception){
            return response()->json([
                'is_successful' => false,
                'error_message' => 'Can\'t Create Patient Request'
            ]);
        }

    }

    public function upload_radiology_prescription(Request $request){
        $validator = Validator::make($request->all(),[
            'api_key'=>'required',
            'image'=>'required',
            'request_id'=>'bail|required|numeric'
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json([
                'is_successful' => false,
                'error_message' => reset($errors)
            ]);
        }
        $login = PatientLogin::where('api_key',$request->input('api_key'))->first();
        if(is_null($login)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Invalid Api Key'
            ]);
        }
        $patient_request = PatientRequest::find($request->input('request_id'));
        if(is_null($patient_request)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Invalid Request Id'
            ]);
        }
        $path = $this->decodeBase64Image($request->input('image'),$request->input('request_id'));
        $patient_upload = new PatientUpload(['image_url'=>$path]);
        $patient_request->request_uploads()->save($patient_upload);
        return response()->json([
            'is_successful'=>true
        ]);
    }

    public function get_radiology_response(Request $request){
        $validator = Validator::make($request->all(),[
            'api_key'=>'bail|required',
            'radiology_request_id'=>'bail|required'
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json([
                'is_successful'=>false,
                'error_message'=>reset($errors)
            ]);
        }
        $login = PatientLogin::where('api_key',$request->input('api_key'))->first();
        if(is_null($login)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Invalid Api Key'
            ]);
        }
        $patientRequest = PatientRequest::find($request->input('radiology_request_id'));
        if(is_null($patientRequest)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Request Id '.$request->input('radiology_request_id') . ' Not found'
            ]);
        }
        $centerResponse = $patientRequest->center_response;
        $centers = $centerResponse->centers()->with('phones')->get();
        $radiology_types = $centerResponse->radiology_types;
        $response = [
            'is_successful'=>true,
            'deliveryEstimateDateTime'=>$centerResponse->delivery_est_datetime,
            'radiology_items'=>$radiology_types->map(function($item){
                return [
                    'typeName'=>$item->ar_name . '-'.$item->en_name,
                    'price'=>$item->pivot->price,
                    'definition'=>$item->pivot->definition,
                    'preparation'=>$item->pivot->preparation,
                    'notes'=>$item->pivot->notes
                ];
            })
        ];
        if($centerResponse->is_at_home){
            $response['radiologyDateTime'] = $centerResponse->radiology_datetime;
        }else{
            $response['centersList'] = $centers->map(function($item){
                return [
                    'centerId'=>$item->id,
                    'centerName'=>$item->name,
                    'centerAddress'=>$item->address,
                    'centerPhones'=>$item->phones->map(function($item){return $item->phone;}),
                    'centerMapLocation'=>$item->map_location,
                    'dateTime'=>$item->pivot->arrive_datetime
                ];
            });
        }

        return response()->json($response);

    }
    public function answer_radiology_question(Request $request){
        $validator = Validator::make($request->all(),[
            'api_key'=>'bail|required',
            'radiology_request_id'=>'bail|required'
        ]);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            return response()->json([
                'is_successful'=>false,
                'error_message'=>reset($errors)
            ]);
        }
        $login = PatientLogin::where('api_key',$request->input('api_key'))->first();
        if(is_null($login)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Invalid Api Key'
            ]);
        }
        $patientRequest = PatientRequest::find($request->input('radiology_request_id'));
        if(is_null($patientRequest)){
            return response()->json([
                'is_successful'=>false,
                'error_message'=>'Request Id '.$request->input('radiology_request_id') . ' Not found'
            ]);
        }
        try{
            $patientRequest->answers()->createMany($request->input('questions_list'));
            return response()->json(['is_successful'=>true]);
        }catch (Exception $exception){
            return response()->json(['is_successful'=>false,'error_message'=>$exception->getMessage()]);
        }
    }

    private function getMIMETYPE($base64string){
        preg_match("/^data:image\/(.*);base64/",$base64string, $match);
        return $match[1];
    }

    private function decodeBase64Image($base64_str,$id){
        $imageType = $this->getMIMETYPE($base64_str);
        $base64 = substr($base64_str, strpos($base64_str, ",")+1);
        $image = base64_decode($base64);
        $url = "prescription_".$id."_".time().".".$imageType;
        $path = public_path()."/uploads/".$url;
        file_put_contents($path,$image);
        return $url;
    }
}