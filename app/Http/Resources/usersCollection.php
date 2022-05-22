<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class usersCollection extends ResourceCollection
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
            'data' => [
                'users' => $this->collection->map(function ($data) {
                    return [
                        'id' => $data->id,
                        'name' => $data->name,
                        'email' => $data->email,
                    ];
                })
            ]
        ];
    }
}
