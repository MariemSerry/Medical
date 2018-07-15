<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Patient extends Model
{

    protected $table = "patient";
    public static function CreatePatient($FirstName,$LastName,$SSN,$Gender,$Phone,$Email,$Password,$Birthdate)
    {
        if (is_null($FirstName) || is_null($LastName) || is_null($SSN) ||
            is_null($Gender) || is_null($Phone) || is_null($Email) || is_null($Password) || is_null($Birthdate))
            return ["valid" => false, "message" => "signup failed", "error" => "$FirstName,$LastName,$SSN,$Gender,$Phone,$Email,$Password,$Birthdate"];
        $patient = new Patient();
        $patient->first_name = $FirstName;
        $patient->last_name = $LastName;
        $patient->ssn = $SSN;
        $patient->gender = $Gender;
        $patient->phone = $Phone;
        $patient->email = $Email;
        $patient->password = $Password;
        $patient->birthdate = $Birthdate;
        try {
            $patient->save();
            return ["valid" => true, "message" => "signed up successfully", "data" => $patient];
        } catch (\Exception $e) {

//            return $e;
            return["valid"=>false,"message"=>"signup failed","error"=>$e];


        }

    }
    public static function UpdatePatient($ID,$FirstName,$LastName,$SSN,$Gender,$Phone,$Email,$Password,$Birthdate,$Medical_history,$PlaceOfTreatment,$profile_picture)
    {
//        if (is_null($FirstName) || is_null($LastName) || is_null($SSN) || is_null($Gender) || is_null($Phone) ||
//            is_null($Email) || is_null($Password) || is_null($Birthdate) || is_null($Medical_history) ||
//            is_null($PlaceOfTreatment) || is_null($ID)||is_null($profile_picture))
//            return ["valid" => false, "message" => "update failed", "error" => "mandatory field missing"];
        $PatientArray = Patient::where('id', $ID)->get();
        $patient = $PatientArray[0];
        $patient->profile_picture=$profile_picture;
        $patient->first_name = $FirstName;
        $patient->last_name = $LastName;
        $patient->ssn = $SSN;
        $patient->gender = $Gender;
        $patient->phone = $Phone;
        $patient->email = $Email;
        if($Password!="")
            $patient->password = $Password;
        $patient->birthdate = $Birthdate;
        $patient->medical_history=$Medical_history;
        $patient->sanctuary_id=$PlaceOfTreatment;
        try {
            $patient->save();
            return ["valid" => true, "message" => "updated successfully", "data" => $patient];
        } catch (\Exception $e) {

//            return $e;
            return ["valid" => false, "message" => "update failed", "error" => $e];

        }
    }

    public static function login($email,$password){
        if(is_null($email)||is_null($password))
            return["valid"=>false,"message"=>"Login failed","error"=>"mandatory field missing"];
        $patient=Patient::where('email',$email)->get(); //select* from patient where email = $email
        if(count($patient) > 0){
            if(Hash::check($password,$patient[0]->password)){
                return["valid"=>true,"message"=>"login successfully","data"=>$patient[0]];
            }
        }
        return["valid"=>false,"message"=>"login failed","error"=>"invalid username or password"];
    }

    public static function getDoctors($PatientID){
        $Doctors=DB::table('patient_doctor')
            ->join('doctor','doctor_id','=','doctor.id')
            ->where('patient_doctor.patient_id','=',$PatientID)
            ->select('doctor.first_name','doctor.last_name','doctor.id')
            ->get();
        return ["valid" => true, "message" => "doctors retrieved successfully", "data" => $Doctors];

    }

    public static function getMedicines($PatientID){
        $medicines=DB::table('patient_medicines')
            ->join('medicine','medicine_id','=','medicine.id')
            ->where('patient_medicines.patient_id','=',$PatientID)
            ->select('medicine.name','medicine.id','patient_medicines.from','patient_medicines.to','patient_medicines.time')
            ->get();
        return ["valid" => true, "message" => "medicines retrieved successfully", "data" => $medicines];

    }

    public static function destroy($ID)
    {

        try{
            $patient = Patient::find($ID);
            $patient->delete();
            Notifications::createNotification(-1,$ID,"doctor has deleted you");

            return["valid"=>true,"message"=>"patient deleted successfully" ];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"deleting patient failed","error"=>$e];


        }

    }

    public static function getAllPatients(){

        return ["valid" => true, "message" => "patients retrieved successfully", "data" => Patient::all()];
    }
    public static function getPatient($PatientID){
        $Patientarray = Patient::where('id', $PatientID)->get();
        $Patient=$Patientarray[0];
        $Patient->Sanctuary;
        return ["valid" => true, "message" => "patient retrieved successfully", "data" => $Patient];
    }
    public function Sanctuary(){
        return $this->belongsTo('App\Sanctuary');
    }
    public static function getComments($PatientID){
        $comments=DB::table('patient_doctor')
            ->join('doctor','doctor_id','=','doctor.id')
            ->where('patient_doctor.patient_id','=',$PatientID)
            ->select('doctor.first_name','doctor.last_name','patient_doctor.comments')
            ->get();
        return ["valid" => true, "message" => "medicines retrieved successfully", "data" => $comments];

    }


}
