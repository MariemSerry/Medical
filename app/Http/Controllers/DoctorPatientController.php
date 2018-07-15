<?php

namespace App\Http\Controllers;

use App\DoctorPaient;
use http\Env\Response;
use Illuminate\Http\Request;

class DoctorPatientController extends Controller
{
    public function AddDoctorPatient(Request $request){
        $DoctorID=$request->input('doctor');
        $PatientID=$request->input('patient');
        $AddDoctorPatient=DoctorPaient::AddDoctorPatient($DoctorID,$PatientID);
        return response($AddDoctorPatient);

    }
    public function AddComment(Request $request){
        $DoctorID=$request->input('doctor');
        $PatientID=$request->input('patient');
        $Comment=$request->input('comment');
        $AddComment=DoctorPaient::AddComment($DoctorID,$PatientID,$Comment);
        return response($AddComment);

    }
    public function deleteComment(Request $request){
        $ID=$request->input('id');
        $deleteCommentResponse=DoctorPaient::destroyComment($ID);
        return response($deleteCommentResponse);
    }

    public function deleteDoctorPatient(Request $request){
        $DoctorID=$request->input('doctor_id');
        $patientID=$request->input('patient_id');
        $DeleteDoctorResponse=DoctorPaient::deleteDoctor($DoctorID,$patientID);
        return response($DeleteDoctorResponse);
    }

}
