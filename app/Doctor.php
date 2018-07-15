<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Doctor extends Model
{
    protected $table = "doctor";
    public static function createDoctor($FirstName,$LastName,$SSN,$Specification,$Gender,$Phone,$Email,$Password,$Birthdate){
//        dd($FirstName);
        if(is_null($FirstName)||is_null($LastName)||is_null($SSN)||is_null($Specification)||
            is_null($Gender)||is_null($Phone)||is_null($Email)||is_null($Password)||is_null($Birthdate))

            return["valid"=>false,"message"=>"signup failed","error"=>"$FirstName,$LastName,$SSN,$Specification,$Gender,$Phone,$Email,$Password,$Birthdate"];
        $doctor = new Doctor();
        $doctor->first_name=$FirstName;
        $doctor->last_name=$LastName;
        $doctor->ssn=$SSN;
        $doctor->specification=$Specification;
        $doctor->gender=$Gender;
        $doctor->phone=$Phone;
        $doctor->email=$Email;
        $doctor->password=$Password;
        $doctor->birthdate=$Birthdate;
        try{
            $doctor->save();
            return["valid"=>true,"message"=>"signed up successfully","data"=>$doctor];
        }catch(\Exception $e){

//            return $e;
            return["valid"=>false,"message"=>"signup failed","error"=>$e];


        }

    }
    public static function login ($email,$password){
        if(is_null($email)||is_null($password))
            return["valid"=>false,"message"=>"Login failed","error"=>"mandatory field missing"];
        $doctor=Doctor::where('email',$email)->get(); //select* from doctor where email = $email
        if(count($doctor) > 0){
            if(Hash::check($password,$doctor[0]->password)){
                return["valid"=>true,"message"=>"login successfully","data"=>$doctor[0]];
            }
        }
        return["valid"=>false,"message"=>"login failed","error"=>"invalid username or password"];
    }
    public static function UpdateDoctor($ID,$FirstName,$LastName,$SSN,$Specification,$Gender,$Phone,$Email,$Password,$Birthdate,$Experience,$profile_picture)
    {
//        if (is_null($FirstName) || is_null($LastName) || is_null($SSN) || is_null($Specification) || is_null($Experience) ||
//            is_null($Gender) || is_null($Phone) || is_null($Email) || is_null($Password) || is_null($Birthdate) || is_null($ID)||is_null($profile_picture))
//            return ["valid" => false, "message" => "update failed", "error" => "mandatory field missing"];
        $doctorArray = Doctor::where('id', $ID)->get();
        $doctor = $doctorArray[0];
        $doctor->profile_picture=$profile_picture;
        $doctor->first_name = $FirstName;
        $doctor->last_name = $LastName;
        $doctor->ssn = $SSN;
        $doctor->specification = $Specification;
        $doctor->gender = $Gender;
        $doctor->phone = $Phone;
        $doctor->email = $Email;
        if($Password!="")
            $doctor->password = $Password;
        $doctor->birthdate = $Birthdate;
        $doctor->experience = $Experience;
        try {
            $doctor->save();
            return ["valid" => true, "message" => "updated successfully", "data" => $doctor];
        } catch (\Exception $e) {

//            return $e;
            return ["valid" => false, "message" => "update failed", "error" => $e];

        }
    }
    public static function DoctorRating($PatientID,$DoctorID,$rating){
        try{
           $rate = DB::table('doctor_rating')->insert(
                ['rating' => $rating, 'patient_id' => $PatientID,'doctor_id'=>$DoctorID]
            );
            self::averageRate($DoctorID);
            return ["valid" => true, "message" => "rated successfully", "data" => $rate];
        }catch (\Exception $e){
            try{
               $rate = DB::table('doctor_rating') ->where('patient_id', $PatientID)
                    ->where('doctor_id',$DoctorID)
                    ->update(['rating' => $rating]);
                self::averageRate($DoctorID);
                return ["valid" => true, "message" => "rated successfully", "data" => $rate];
            }catch (\Exception $e){
                return ["valid" => false, "message" => "rating failed", "error" => $e];
            }
        }
    }
    public static function averageRate($doctor_id){
        $rates=DB::table('doctor_rating')->where('doctor_id',$doctor_id)->select('rating')->get();
        $totalRate=0;
        foreach($rates as $rate){
            $totalRate+=$rate->rating;
        }
        $averageRate=$totalRate/count($rates);
        $doctor=Doctor::find($doctor_id);
        $doctor->rating = $averageRate;
        $doctor->save();
    }
    public static function getDocPatients($DoctorID){
        $patients=DB::table('patient_doctor')
            ->join('patient','patient_id','=','patient.id')
            ->where('patient_doctor.doctor_id','=',$DoctorID)
            ->select('patient.first_name','patient.last_name','patient.id','patient_doctor.comments')
            ->get();
        return ["valid" => true, "message" => "patients retrieved successfully", "data" => $patients];

    }

    public static function getSanctuary($DoctorID){
        $Sanctuary=DB::table('doctor_sanctuary')
            ->join('sanctuary','sanctuary_id','=','sanctuary.id')
            ->where('doctor_sanctuary.doctor_id','=',$DoctorID)
            ->select('sanctuary.name','sanctuary.id')
            ->get();
        return ["valid" => true, "message" => "Sanctuary retrieved successfully", "data" => $Sanctuary];

    }
    public static function getAllDoctors(){

        return ["valid" => true, "message" => "doctors retrieved successfully", "data" => Doctor::all()];
    }

    public static function getDoctor($DoctorID){
    $doctorArray = Doctor::where('id', $DoctorID)->get();
    $doctor=$doctorArray[0];
    $Sanctuary=DB::table('doctor_sanctuary')
        ->join('sanctuary','sanctuary_id','=','sanctuary.id')
        ->where('doctor_sanctuary.doctor_id','=',$DoctorID)
        ->select('sanctuary.name','sanctuary.id')
        ->get();
    $data=["doctor"=>$doctor,"sanctuary"=>$Sanctuary];
    return ["valid" => true, "message" => "doctor retrieved successfully", "data" => $data];
}
    public static function destroyDoctor($ID)
    {
        try{
            $doctor = doctor::find($ID);
            $doctor->delete();
            Notifications::createNotification($ID,-1,"Patient has deleted you");

            return["valid"=>true,"message"=>"doctor deleted successfully" ];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"deleting doctor failed","error"=>$e];


        }



    }


}

