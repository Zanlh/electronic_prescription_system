<?php

namespace App\Http\Controllers\Api;

use App\Models\medicine;
use App\Models\treatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\MedicineResource;

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
}
