<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddRequest extends Model
{
    protected $table = "add_request";
    public static function SendRequest($DoctorID,$PatientID,$To){
        if (is_null($DoctorID) || is_null($PatientID) || is_null($To) )
            return ["valid" => false, "message" => "request failed", "error" => "mandatory field missing"];
        $AddRequest = new AddRequest();
        $AddRequest->doctor = $DoctorID;
        $AddRequest->patient= $PatientID;
        $AddRequest->to = $To;
        try {
            $AddRequest->save();
            return ["valid" => true, "message" => "request sent successfully", "data" => $AddRequest];
        } catch (\Exception $e) {

            return["valid"=>false,"message"=>"request failed","error"=>$e];

        }

    }

    public static function DeleteRequest($DoctorID,$PatientID,$To){
            $AddRequest = DB::table('add_request')->where('doctor',$DoctorID)->where('patient',$PatientID)->where('to',$To);
            $AddRequest->delete();
        return ["valid" => true, "message" => "request deleted successfully"];

    }
        public static function ResponseToRequest($DoctorID,$PatientID,$To,$Response){
            if (is_null($DoctorID) || is_null($PatientID) || is_null($To) )
                return ["valid" => false, "message" => "request failed", "error" => "mandatory field missing"];
           self::DeleteRequest($DoctorID,$PatientID,$To);
           if($Response=="accept"){
               return DoctorPaient::AddDoctorPatient($DoctorID,$PatientID);
           }
            return ["valid" => true, "message" => "request deleted successfully"];



        }
    public static function getRequests($Type,$ID){
        if($Type=="doctor"){
            return  AddRequest::where('doctor',$ID)->where('to',$Type)->get();

        }
        return AddRequest::where('patient',$ID)->where('to',$Type)->get();

    }






}
