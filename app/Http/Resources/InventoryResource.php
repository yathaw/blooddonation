<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\User;
use App\Http\Resources\UserResource;

use App\Models\Blood;
use App\Http\Resources\BloodResource;

use App\Models\Donor;
use App\Http\Resources\DonorResource;

class InventoryResource extends JsonResource
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
            'id'        => $this->id,
            'count'       => $this->count,
            'dod'     => $this->dod,
            'status'   => $this->status,

            'donor_id'         => $this->donor_id,
            'donor'       => new DonorResource(Donor::find($this->donor_id)),

            'blood_id'        => $this->blood_id,
            'blood'           => new BloodResource(Blood::find($this->blood_id)),

            'user_id'         => $this->user_id,
            'user'            => new UserResource(User::find($this->user_id)),

            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}
