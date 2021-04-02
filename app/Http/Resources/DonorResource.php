<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\User;
use App\Http\Resources\UserResource;

use App\Models\Blood;
use App\Http\Resources\BloodResource;

use App\Models\Inventory;
use Carbon\Carbon;

class DonorResource extends JsonResource
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
        $donor_id = $this->id;

        $inventories = Inventory::where('donor_id',$donor_id)->orderByRaw("count DESC")->get();

        // dd($inventories->isEmpty());

        if ($inventories->isEmpty()) {
            $lastdate = NULL;

            $count = '0';   
        }
        else{
            $count = $inventories[0]->count;
            $dod = \Carbon\Carbon::parse($inventories[0]->dod);
            $lastdate = $dod->format('M d, Y');

        }

        return [
            'id'        => $this->id,
            'dob'       => $this->dob,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'frequency' => $count,
            'lastdate' => $lastdate,


            'blood_id'        => $this->blood_id,
            'blood'           => new BloodResource(Blood::find($this->blood_id)),

            'user_id'         => $this->user_id,
            'user'            => new UserResource(User::find($this->user_id)),

            'created_id'         => $this->created_id,
            'created_user'       => new UserResource(User::find($this->created_id)),

            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}
