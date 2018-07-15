<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\medicine;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function CreateDoctor(Request $request){
        $FirstName=$request->input('first_name');
        $LastName=$request->input('last_name');
        $SSN=$request->input('ssn');
        $Specification=$request->input('specification');
        $Gender=$request->input('gender');
        $Phone=$request->input('phone');
        $Email=$request->input('email');
        $Password=bcrypt($request->input('password'));
        $Birthdate=$request->input('birthdate');
//        dd($FirstName);
        $createDoctorResponse=Doctor::createDoctor($FirstName,$LastName,$SSN,$Specification,$Gender,$Phone,$Email,$Password,$Birthdate);
        return response($createDoctorResponse);
    }
    public function update(Request $request){
        $ID=$request->input('id');
        $FirstName=$request->input('first_name');
        $LastName=$request->input('last_name');
        $SSN=$request->input('ssn');
        $Specification=$request->input('specification');
        $Gender=$request->input('gender');
        $Phone=$request->input('phone');
        $Email=$request->input('email');
        $Password="";
        if($request->input('password') != "")
            $Password=bcrypt($request->input('password'));
        $Experience=$request->input('experience');
        $Birthdate=$request->input('birthdate');
        $profile_picture=$request->input('profile_picture');
        $UpdateDoctorResponse=Doctor::UpdateDoctor($ID,$FirstName,$LastName,$SSN,$Specification,$Gender,$Phone,$Email,$Password,$Birthdate,$Experience,$profile_picture);
        return response($UpdateDoctorResponse);
    }
    public function getDocPatients(Request $request){
        $DoctorID=$request->input('doctor_id');
        $getpatients=Doctor::getDocPatients($DoctorID);
        return response($getpatients);
    }

    public function GetSanctuary(Request $request){
        $DoctorID=$request->input('doctor_id');
        $getSanctuary=Doctor::getSanctuary($DoctorID);
        return response($getSanctuary);
    }

    public function deletePatient(Request $request){
        $ID=$request->input('id');
        $deletePatientResponse=Patient::destroy($ID);
        return response($deletePatientResponse);
    }

    public function deleteDoctor(Request $request){
        $ID=$request->input('id');
        $deleteDoctorResponse=doctor::destroyDoctor($ID);
        return response($deleteDoctorResponse);
    }

    public function addMedicine(Request $request){
        $Name=$request->input('name');

        $addMedicineResponse=medicine::addMedicines($Name);
        return response($addMedicineResponse);
    }



    public function deleteMedicine(Request $request){
        $ID=$request->input('id');
        $deleteMedicineResponse=medicine::destroy($ID);
        return response($deleteMedicineResponse);
    }
    public function getAllDoctors(){
        $getDoctors=Doctor::getAllDoctors();
        return response($getDoctors);
    }
    public function getDoctor(Request $request){
        $DoctorID=$request->input('doctor_id');
        $getDoctor=Doctor::getDoctor($DoctorID);
        return response($getDoctor);

    }



}

