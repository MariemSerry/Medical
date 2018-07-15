<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DoctorPaient extends Model
{
    protected $table = "patient_doctor";
    public static function AddDoctorPatient($DoctorID,$PatientID){
    if (is_null($DoctorID) || is_null($PatientID))
        return ["valid" => false, "message" => "adding failed", "error" => "mandatory field missing"];
    $DoctorPatient = new DoctorPaient();
    $DoctorPatient->doctor_id=$DoctorID;
    $DoctorPatient->patient_id=$PatientID;


    try{
        $DoctorPatient->save();
        return["valid"=>true,"message"=>"DoctorPatient added successfully","data"=>$DoctorPatient];
    }catch(\Exception $e){

        //return $e;
        return["valid"=>false,"message"=>"adding DoctorPatient failed","error"=>$e];


    }

}
    public static function AddComment($DoctorID,$PatientID,$Comment){
        if (is_null($DoctorID) || is_null($PatientID)|| is_null($Comment))
            return ["valid" => false, "message" => "adding comment failed", "error" => "mandatory field missing"];
        $record = DB::select("update patient_doctor set comments='$Comment' WHERE doctor_id=$DoctorID and patient_id=$PatientID");
//        dd($record);
        try{
//            $record->save();
//            dd("save");
            Notifications::createNotification(-1,$PatientID,"new comment");
            return["valid"=>true,"message"=>"comment added successfully","data"=>$record];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"adding comment failed","error"=>$e];


        }

    }

    public static function deleteDoctor($DoctorID,$patientID)
    {
        try{  DoctorPaient::where('patient_id',$patientID)->where('doctor_id',$DoctorID)->delete();

            return["valid"=>true,"message"=>"doctor deleted successfully" ];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"deleting doctor failed","error"=>$e];


        }

    }



}
