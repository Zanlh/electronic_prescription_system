<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\medicine;
use App\Models\treatement;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\IssueCollection;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\usersCollection;
use App\Http\Resources\MedicineCollection;
use App\Http\Resources\TreatementCollection;
use App\Http\Resources\PrescriptionCollection;
use App\Models\Issue;

class PageController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $data = new ProfileResource($user);
        return success('success', $data);
    }

    public function doctorProfile(Request $request)
    {
        $doctor =   $request->user('doctor-api');
        $data = new DoctorResource($doctor);
        return success('success', $data);
    }


    public function Users(){
        $users = User::all();
        $data = new usersCollection($users);
        return success('success', $data);

    }

    public function Medicine(){
        $medicines =  DB::table('medicines')->where('user_id',auth()->user()->id)->get();
        $data = new MedicineCollection($medicines);
        return success('success', $data);

    }

    public function Treatment(){
        $treatments = DB::table('treatements')->where('user_id',auth()->user()->id)->get();
        $data = new TreatementCollection($treatments);
        return success('success', $data);

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

    public function addIssue(Request $request){
        $doctor =   $request->user('doctor-api');
        $issue = new Issue();
        $issue->user_id=$request->user_id;
        $issue->doctor_id=$doctor->id;
        $issue->token = mt_rand(10000,99999);
        $issue->save();
        return success('Issue added.', $issue);


    }
    public function addPrescription(Request $request){
        $prescription = new Prescription();
        $prescription->name = $request->name;
        $prescription->dosage=$request->dosage;
        $prescription->quantity=$request->quantity;
        $prescription->advice=$request->advice;
        $prescription->reaction=$request->reaction;
        $prescription->issue_id=$request->issue_id;
        $prescription->save();

        return success('Prescription added.', $prescription);

    }

    public function Prescription($id){
        $prescription = DB::table('prescriptions')->where('issue_id',$id)->get();
        $data = new PrescriptionCollection($prescription);
        return success('success', $data);
    }

    public function Issue(){
        $issue = DB::table('issues')->where('user_id',auth()->user()->id)->get();
        $data = new IssueCollection($issue);
        return success('success', $data);
    }
}
