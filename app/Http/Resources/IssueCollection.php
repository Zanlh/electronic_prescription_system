<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IssueCollection extends ResourceCollection
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
                'issues'=>$this->collection->map(function($data){
                    return[
                        'id' => $data->id,
                        'user_id' => $data->user_id,
                        'doctor_id' => $data->doctor_id,
                        'token' => $data->token,
                        'created_at'=>Carbon::parse($data->created_at)->format('Y-m-d H:i:s'),
                    ];
                })
            ]
            ];
    }
}
