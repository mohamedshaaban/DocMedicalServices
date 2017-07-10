<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'v1','namespace'=>'Api'],function(){
    Route::post('patient_request_radiology','PatientController@patient_request_radiology');
    Route::post('upload_radiology_prescription','PatientController@upload_radiology_prescription');
    Route::post('patient_get_radiology_response','PatientController@get_radiology_response');
    Route::post('patient_answer_radiology_question','PatientController@answer_radiology_question');
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
