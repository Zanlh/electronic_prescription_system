<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PrescriptionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data'=>[
                'prescriptions'=>$this->collection->map(function($data){
                    return[
                        'id' => $data->id,
                        'name' => $data->name,
                        'dosage' => $data->dosage,
                        'quantity' => $data->quantity,
                        'advice' => $data->advice,
                        'reaction' => $data->reaction,
                        'doctor_id' => $data->doctor_id,
                        'created_at'=>Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
                    ];
                })
            ]
            ];
    }
}
