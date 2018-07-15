<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSanctuary extends Model
{

    protected $table = "doctor_sanctuary";
    public static function AddSanctuary($DoctorID,$sanctuaryID){
        if (is_null($DoctorID) || is_null($sanctuaryID))
            return ["valid" => false, "message" => "adding sanctuary failed", "error" => "mandatory field missing"];
        $DoctorSanctuary = new DoctorSanctuary();
        $DoctorSanctuary ->doctor_id=$DoctorID;
        $DoctorSanctuary ->sanctuary_id=$sanctuaryID;

        try{
            $DoctorSanctuary ->save();
            return["valid"=>true,"message"=>"Sanctuary added successfully","data"=>$DoctorSanctuary ];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"adding DoctorSanctuary failed","error"=>$e];


        }

    }
    public static function deleteSanctuary($DoctorID,$sanctuaryID)
    {
        try{        DoctorSanctuary::where('sanctuary_id',$sanctuaryID)->where('doctor_id',$DoctorID)->delete();

            return["valid"=>true,"message"=>"Sanctuary deleted successfully" ];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"deleting DoctorSanctuary failed","error"=>$e];


        }

    }
}
