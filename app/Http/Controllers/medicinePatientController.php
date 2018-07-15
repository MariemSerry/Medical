<?php

namespace App\Http\Controllers;

use App\medicinePatient;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class medicinePatientController extends Controller
{
    public function AddMedicinePatient(Request $request){
        $MedicineID=$request->input('medicine');
        $PatientID=$request->input('patient');
        $From=$request->input('from');
        $To=$request->input('to');
        $Time=$request->input('time');
        $AddMedicinePatient=medicinePatient::AddMedicine($MedicineID,$PatientID,$Time,$From,$To);
        return response($AddMedicinePatient);
    }
    public function UpdateMedicine(Request $request){
        $ID=$request->input('id');
        $From=$request->input('from');
        $To=$request->input('to');
        $Time=$request->input('time');
        $PatientID=$request->input('patient');

        $UpdateMedicinePatient=medicinePatient::UpdateMedicine($ID,$Time,$From,$To,$PatientID);
        return response($UpdateMedicinePatient);


    }
    public function deleteMedicine(Request $request){
        $ID=$request->input('id');
        $PatientID=$request->input('patient');

        $deleteMedicineResponse=medicinePatient::deleteRecord($ID,$PatientID);
        return response($deleteMedicineResponse);
    }
}
