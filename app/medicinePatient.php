<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class medicinePatient extends Model
{
    protected $table = "patient_medicines";
    public static function AddMedicine($MedicineID,$PatientID,$Time,$From,$To){
        if (is_null($MedicineID) || is_null($PatientID)||is_null($To)||is_null($From)||is_null($Time))
            return ["valid" => false, "message" => "adding medicine failed", "error" => "mandatory field missing"];
        $patientMedicine = new medicinePatient();
        $patientMedicine->medicine_id=$MedicineID;
        $patientMedicine->patient_id=$PatientID;
        $patientMedicine->to=$To;
        $patientMedicine->from=$From;
        $patientMedicine->time=$Time;

        try{
            $patientMedicine->save();
            Notifications::createNotification(-1,$PatientID,"new medicine is added");
            return["valid"=>true,"message"=>"patientMedicine added successfully","data"=>$patientMedicine];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"adding patientMedicine failed","error"=>$e];


        }

    }
    public static function UpdateMedicine($ID,$Time,$From,$To,$PatientID)
    {
        if (is_null($ID) || is_null($From) || is_null($To) || is_null($Time))
            return ["valid" => false, "message" => "update failed", "error" => "mandatory field missing"];
        $medicinePatient = medicinePatient::where('id', $ID)->get();
        $medicinePatient = $medicinePatient[0];
        $medicinePatient->from=$From;
        $medicinePatient->to = $To;
        $medicinePatient->time = $Time;

        try {
            $medicinePatient->save();
            Notifications::createNotification(-1,$PatientID,"medicine is edited");

            return ["valid" => true, "message" => "updated successfully", "data" => $medicinePatient];
        } catch (\Exception $e) {

//            return $e;
            return ["valid" => false, "message" => "update failed", "error" => $e];

        }
    }
    public static function deleteRecord($ID,$PatientID)
    {
        medicinePatient::where('medicine_id',$ID)->where('patient_id',$PatientID)->delete();
        Notifications::createNotification(-1,$PatientID,"medicine is deleted");


    }
}
