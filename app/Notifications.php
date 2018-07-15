<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class Notifications extends Model
{
    protected $table = "notifications";
    public static function createNotification($DoctorID,$PatientID,$Notification)
    {
        if (is_null($DoctorID) || is_null($PatientID) || is_null($Notification))
            return ["valid" => false, "message" => "adding notification failed", "error" => "mandatory field missing"];
        $notification = new Notifications();
        $notification->doctor_id = $DoctorID==-1?null:$DoctorID;
        $notification->patient_id = $PatientID==-1?null:$PatientID;
        $notification->notification = $Notification;


        try {
            $notification->save();
            return ["valid" => true, "message" => "notification added successfully", "data" => $notification];
        } catch (\Exception $e) {

            //return $e;
            return ["valid" => false, "message" => "adding notification failed", "error" => $e];


        }
    }
    public static function getNotifications($Type,$ID){
        if($Type=="doctor"){
          return  Notifications::where('doctor_id',$ID)->get();
        }
        else{
            $notifications=DB::table('notifications')
                ->where('notifications.patient_id','=',$ID)
                ->select('notifications.notifications')
                ->get();
            return ["valid" => true, "message" => "notifications retrieved successfully", "data" => $notifications];
        }



    }
}
