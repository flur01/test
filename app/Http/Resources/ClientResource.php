<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
         'id' => $this->id,
         'name' => $this->name,
         'address1' => $this->address1,
         'address2' => $this->address2,
         'city' => $this->city,
         'state' => $this->state,
         'country' => $this->country,
         'zip_code' => $this->zip_code,
         'latitude' => $this->latitude,
         'longitude' => $this->longitude,
         'phone_no1' => $this->phone_no1,
         'phone_no2' => $this->phone_no2,
         'user' => [
             'all' => $this->all_users,
             'active' => $this->active_users,
             'inactive' => $this->inactive_users,
         ],
        'start_validity' => $this->start_validity,
        'end_validity' => $this->end_validity,
        'status' => $this->status,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
       ];
    }
}
