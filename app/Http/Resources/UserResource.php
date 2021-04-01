<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        $role = $this->roles->pluck('name');

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,

            'role'         => $role[0],


            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];

    }
}
