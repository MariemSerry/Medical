<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function CreatePatient(Request $request){
        $FirstName=$request->input('first_name');
        $LastName=$request->input('last_name');
        $SSN=$request->input('ssn');
        $Gender=$request->input('gender');
        $Phone=$request->input('phone');
        $Email=$request->input('email');
        $Password=bcrypt($request->input('password'));
        $Birthdate=$request->input('birthdate');
        $CreatePatientResponse=Patient::CreatePatient($FirstName,$LastName,$SSN,$Gender,$Phone,$Email,$Password,$Birthdate);
        return response($CreatePatientResponse);
    }
    public function update(Request $request){
        $ID=$request->input('id');
        $FirstName=$request->input('first_name');
        $LastName=$request->input('last_name');
        $SSN=$request->input('ssn');
        $Gender=$request->input('gender');
        $Phone=$request->input('phone');
        $Email=$request->input('email');
        $Password="";
        if($request->input('password') != "")
            $Password=bcrypt($request->input('password'));
        $Birthdate=$request->input('birthdate');
        $Medical_history=$request->input('medical_history');
        $PlaceOfTreatment=$request->input('sanctuary_id');
        $profile_picture=$request->input('profile_picture');
        $UpdatePatientResponse=Patient::UpdatePatient($ID,$FirstName,$LastName,$SSN,$Gender,$Phone,$Email,$Password,$Birthdate,$Medical_history,$PlaceOfTreatment,$profile_picture);
        return response($UpdatePatientResponse);
    }
    public function RateDoctor(Request $request){
        $PatientID=$request->input('patient_id');
        $DoctorID=$request->input('doctor_id');
        $Rating=$request->input('rating');
        $rateResponse=Doctor::DoctorRating($PatientID,$DoctorID,$Rating);
        return response($rateResponse);
    }

    public function GetDoctors(Request $request){
        $PatientID=$request->input('patient_id');
        $getDoctors=Patient::getDoctors($PatientID);
        return response($getDoctors);
    }

    public function GetMedicines(Request $request){
        $PatientID=$request->input('patient_id');
        $getMedicines=Patient::getMedicines($PatientID);
        return response($getMedicines);
    }

    public function getPatients(Request $request){
        $getPatients=Patient::getAllPatients();
        return response($getPatients);
    }
    public function getPatient(Request $request){
        $PatientID=$request->input('patient_id');
        $getPatient=Patient::getPatient($PatientID);
        return response($getPatient);

    }
    public function GetComments(Request $request){
        $PatientID=$request->input('patient_id');
        $getComments=Patient::getComments($PatientID);
        return response($getComments);
    }

}
