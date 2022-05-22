<?php

namespace App\Http\Controllers\Api;

use App\Models\medicine;
use App\Models\treatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\MedicineResource;
use App\Http\Resources\PrescriptionCollection;
use App\Models\Prescription;

class PageController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $data = new ProfileResource($user);
        return success('success', $data);
    }

    public function Medicine(){
        $medicines =  DB::table('medicines')->where('user_id',auth()->user()->id)->get();
        // $data = new MedicineResource($medicines);
        return success('success', $medicines);

    }

    public function Treatment(){
        $treatments = DB::table('treatements')->where('user_id',auth()->user()->id)->get();
        // $data = new MedicineResource($medicines);
        return success('success', $treatments);

    }

    public function storeMedicine(Request $request){

        $medicine = new medicine();
        $medicine->name = $request->name;
        $medicine->description = $request->description;
        $medicine->user_id =  auth()->user()->id;
        $medicine->save();
        return success('Medicine added.', $medicine);
    }

    public function storeTreatment(Request $request){

        $treatment = new treatement();
        $treatment->name = $request->name;
        $treatment->description = $request->description;
        $treatment->user_id =  auth()->user()->id;
        $treatment->save();
        return success('Treatment added.', $treatment);
    }

    public function addPrescription(Request $request){
        $doctor =   $request->user('doctor-api');
        $prescription = new Prescription();
        $prescription->name = $request->name;
        $prescription->dosage=$request->dosage;
        $prescription->quantity=$request->quantity;
        $prescription->advice=$request->advice;
        $prescription->reaction=$request->reaction;
        $prescription->user_id=$request->user_id;
        $prescription->doctor_id=$doctor->id;
        $prescription->save();

        return success('Prescription added.', $prescription);

    }

    public function Prescription(){
        $prescription = DB::table('prescriptions')->where('user_id',auth()->user()->id)->get();
        $data = new PrescriptionCollection($prescription);
        return success('success', $data);
    }
}
