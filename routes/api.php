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

Route::post('CreateDoctor','DoctorController@CreateDoctor');
Route::post('UpdateDoctor','DoctorController@update');
Route::post('CreatePatient','PatientController@CreatePatient');
Route::post('Login','LoginController@Login');
Route::post('getDocPatients','DoctorController@getDocPatients');
Route::post('UpdatePatient','PatientController@update');
Route::post('getDoctors','PatientController@GetDoctors');
Route::post('getPatients','PatientController@getPatients');
Route::post('getAllDoctors','DoctorController@getAllDoctors');
Route::post('getDoctor','DoctorController@getDoctor');
Route::post('getPatient','PatientController@getPatient');
Route::post('getSanctuary','DoctorController@GetSanctuary');
Route::post('AddDoctorSanctuary','DoctorSanctuaryController@AddDoctorSanctuary');
Route::post('DeleteDoctorSanctuary','DoctorSanctuaryController@deleteDoctorSanctuary');
Route::post('addSanctuary','sanctuaryController@addSanctuary');
Route::post('updateSanctuary','sanctuaryController@updateSanctuary');
Route::post('deleteSanctuary','sanctuaryController@deleteSanctuary');
Route::post('getMedicines','PatientController@GetMedicines');
Route::post('addMedicine','DoctorController@addMedicine');
Route::post('deleteMedicine','DoctorController@deleteMedicine');
Route::post('GetComments','PatientController@GetComments');
Route::post('getNotifications','NotificationsController@getNotifications');
Route::post('getAvailablePatients','AddRequestController@getAvailablePatients');









Route::post('DoctorRating','PatientController@RateDoctor');
Route::post('deletePatient','DoctorController@deletePatient');
Route::post('AddRequest','AddRequestController@SendRequest');
Route::post('DeleteRequest','AddRequestController@DeleteRequest');
Route::post('AddDoctorPatient','DoctorPatientController@AddDoctorPatient');
Route::post('ResponseRequest','AddRequestController@ResponseToRequest');
Route::post('AddMedicinePatient','medicinePatientController@AddMedicinePatient');
Route::post('UpdateMedicinePatient','medicinePatientController@UpdateMedicine');
Route::post('DeleteMedicinePatient','medicinePatientController@deleteMedicine');
Route::post('AddComment','DoctorPatientController@AddComment');
Route::post('getRequests','AddRequestController@getRequests');
Route::post('getAvailableDoctors','AddRequestController@getAvailableDoctors');
Route::post('deleteDoctor','DoctorController@deleteDoctor');


Route::post('deleteDoctorPatient','DoctorPatientController@deleteDoctorPatient');





























Route::get('test',function(){
    dd("dasda");
});