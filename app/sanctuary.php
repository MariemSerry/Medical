<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sanctuary extends Model
{
    protected $table = "sanctuary";
    public static function addSanctuary($Name,$Location,$Description){
        if(is_null($Name)||is_null($Location)||is_null($Description))
            return["valid"=>false,"message"=>"adding sanctuary failed","error"=>"mandatory field missing"];
        $sanctuary = new sanctuary();
        $sanctuary->name=$Name;
        $sanctuary->location=$Location;
        $sanctuary->description=$Description;


        try{
            $sanctuary->save();
            return["valid"=>true,"message"=>"sanctuary added successfully","data"=>$sanctuary];
        }catch(\Exception $e){

            //return $e;
            return["valid"=>false,"message"=>"adding sanctuary failed","error"=>$e];


        }

    }

    public static function UpdateSanctuary($ID,$Name,$Location,$Description){
        if(is_null($Name)||is_null($Location)||is_null($Description))
            return["valid"=>false,"message"=>"adding sanctuary failed","error"=>"mandatory field missing"];
        $sanctuaryArray = sanctuary::where('id', $ID)->get();
        $sanctuary = $sanctuaryArray[0];
        $sanctuary->name=$Name;
        $sanctuary->location=$Location;
        $sanctuary->description=$Description;

        try {
            $sanctuary->save();
            return ["valid" => true, "message" => "updated successfully", "data" => $sanctuary];
        } catch (\Exception $e) {

//            return $e;
            return ["valid" => false, "message" => "update failed", "error" => $e];

        }
    }
    public static function destroy($ID)
    {
        $sanctuary = sanctuary::find($ID);
        $sanctuary->delete();

    }
}
