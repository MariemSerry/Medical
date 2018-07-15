<?php

namespace App\Http\Controllers;

use App\DoctorSanctuary;
use Illuminate\Http\Request;

class DoctorSanctuaryController extends Controller
{
    public function AddDoctorSanctuary(Request $request){
        $DoctorID=$request->input('doctor_id');
        $SanctuaryID=$request->input('sanctuary_id');
        $AddDoctorSanctuary=DoctorSanctuary::AddSanctuary($DoctorID,$SanctuaryID);
        return response($AddDoctorSanctuary);
    }

    public function deleteDoctorSanctuary(Request $request){
        $DoctorID=$request->input('doctor_id');
        $SanctuaryID=$request->input('sanctuary_id');

        $DeleteDoctorSanctuaryResponse=DoctorSanctuary::deleteSanctuary($DoctorID,$SanctuaryID);
        return response($DeleteDoctorSanctuaryResponse);
    }

}
