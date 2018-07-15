<?php

namespace App\Http\Controllers;

use App\AddRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddRequestController extends Controller
{
    public function getAvailablePatients(Request $request){
        $doctorId=$request->input('doctorId');
        $allPatients = DB::select("select * from patient where id not in (
              select patient_id from patient_doctor where doctor_id = $doctorId
          )");
        $requestedPatients=DB::select("select patient from add_request where doctor = $doctorId");
        $requestedIds = [];
        foreach ($requestedPatients as $req){

            array_push($requestedIds,$req->patient);
        }
        foreach($allPatients as $patient){
            if (in_array($patient->id,$requestedIds)){
                $patient->flag=true;
            }else{
                $patient->flag=false;
            }
        }
        return response(["valid"=>true,"message"=>"retrieved patients successfully","data"=>$allPatients],200);
    }
    public function getAvailableDoctors(Request $request){
        $patientId=$request->input('patientId');
        $allDoctors = DB::select("select * from doctor where id not in (
              select doctor_id from patient_doctor where patient_id = $patientId
          )");
        $requestedDoctors=DB::select("select doctor from add_request where patient = $patientId");
        $requestedIds = [];
        foreach ($requestedDoctors as $req){

            array_push($requestedIds,$req->doctor);
        }
        foreach($allDoctors as $doctor){
            if (in_array($doctor->id,$requestedIds)){
                $doctor->flag=true;
            }else{
                $doctor->flag=false;
            }
        }
        return response(["valid"=>true,"message"=>"retrieved doctors successfully","data"=>$allDoctors],200);

    }
    public function SendRequest(Request $request){
        $DoctorID=$request->input('doctor');
        $PatientID=$request->input('patient');
        $To=$request->input('to');
        $AddRequest=AddRequest::SendRequest($DoctorID,$PatientID,$To);
        return response($AddRequest);
    }

    public function DeleteRequest(Request $request){
        $DoctorID=$request->input('doctor');
        $PatientID=$request->input('patient');
        $To=$request->input('to');
        $DeleteRequest=AddRequest::DeleteRequest($DoctorID,$PatientID,$To);
        return response($DeleteRequest);

    }
    public function ResponseToRequest(Request $request){
        $DoctorID=$request->input('doctor');
        $PatientID=$request->input('patient');
        $To=$request->input('to');
        $Response=$request->input('response');

        $AddRequest=AddRequest::ResponseToRequest($DoctorID,$PatientID,$To,$Response);
        return response($AddRequest);
    }

    public function getRequests(Request $request){
        $Type=$request->input('type');
        $ID=$request->input('id');
        $getRequests=AddRequest::getRequests($Type,$ID);
        return response($getRequests);
    }
}
