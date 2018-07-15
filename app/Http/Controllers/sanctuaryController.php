<?php

namespace App\Http\Controllers;

use App\sanctuary;
use Illuminate\Http\Request;

class sanctuaryController extends Controller
{
    public function addSanctuary(Request $request){
        $Name=$request->input('name');
        $Location=$request->input('location');
        $Description=$request->input('description');
        $addsanctuaryResponse=sanctuary::addSanctuary($Name,$Location,$Description);
        return response($addsanctuaryResponse);
    }

    public function updateSanctuary(Request $request){
        $ID=$request->input('id');
        $Name=$request->input('name');
        $Location=$request->input('location');
        $Description=$request->input('description');
        $UpdateSanctuaryResponse=sanctuary::UpdateSanctuary($ID,$Name,$Location,$Description);
        return response($UpdateSanctuaryResponse);
    }

    public function deleteSanctuary(Request $request){
        $ID=$request->input('id');
        $deleteSanctuaryResponse=sanctuary::destroy($ID);
        return response($deleteSanctuaryResponse);
    }
}
