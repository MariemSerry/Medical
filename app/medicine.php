<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class medicine extends Model
{
    protected $table = "medicine";
    public static function addMedicines($Name){
        if(is_null($Name))
            return["valid"=>false,"message"=>"adding medicine failed","error"=>"mandatory field missing"];
        $medicine = new medicine();
        $medicine->name=$Name;


        try{
            $medicine->save();
            return["valid"=>true,"message"=>"medicine added successfully","data"=>$medicine];
        }catch(\Exception $e){

     //return $e;
            return["valid"=>false,"message"=>"adding medicine failed","error"=>$e];


        }

    }



    public static function destroy($ID)
    {
        $medicine = medicine::find($ID);
        $medicine->delete();

    }
}
