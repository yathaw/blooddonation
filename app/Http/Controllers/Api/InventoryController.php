<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\InventoryResource;
use App\Http\Resources\DonorResource;


use App\Models\Inventory;
use App\Models\Donor;
use App\Models\Blood;
use App\Models\User;

use Validator;
use Carbon\Carbon;

use Auth;

class InventoryController extends Controller
{
    
    public function index()
    {
        $inventories = Inventory::paginate();
        $result = InventoryResource::collection($inventories);

        $message = 'Donation retrieved successfully.';
        $mm_message = 'အလှူမှတ်တမ်းအားအောင်မြင်စွာထုတ်ယူပြီးပါပြီ';

        $status = 200;

        $response = [
            'status'    =>  $status,
            'success'   =>  true,
            'message'   =>  $message,
            'mm_message'   =>  $mm_message,
            'data'      =>  $result,
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $rules = [
            'donor'     => 'required',
            'dod'     => 'required',
        ];

        $customMessages = [
            'donor.required' => 'သွေးလှူဒါန်းသူနာမည်ရွေးပေးရန်လိုအပ်ပါသည်။',
            'dod.required' => 'သွေးလှူဒါန်းသည့်ရက်ဆွဲသိမ်းထားရန်လိုအပ်ပါသည်။',
        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);

        if ($validator->fails()) {
            $status = 400;
            $message = 'Validation Error.';

            $response = [
                'status'    =>  $status,
                'success'   =>  false,
                'message'   =>  $message,
                'data'      =>  $validator->errors(),
            ];

            return response()->json($response);
        }
        else{
            $donorid = $request->donor;
            $dod = $request->dod;

            $authuser = Auth::user();
            $authuser_id = Auth::id();

            $hasDonors_inInventory = Inventory::where('donor_id', $donorid)->get();

            foreach($hasDonors_inInventory as $hasDonor_inInventory){
                $count = $hasDonor_inInventory->count;
                $count_data = ++$count;
            }

            /*insert count*/
            if($hasDonors_inInventory->isEmpty()){
                $count_no = 1;
            }else{
                $count_no = $count_data;
            }

            $donor = Donor::find($donorid);

            $donation = new Inventory();
            $donation->count = $count_no;
            $donation->dod = $dod;
            $donation->status = '0';
            $donation->donor_id = $donorid;
            $donation->blood_id = $donor->blood_id;
            $donation->user_id = 1;
            $donation->save();

            $status = 201;
            $message = 'Donor created successfully.';
            $mm_message = 'အလှူမှတ်တမ်းအားအောင်မြင်စွာထုတ်ယူပြီးပါပြီ';
            $result = new InventoryResource($donation);

            $response = [
                'success'   => true,
                'status'    => $status,
                'message'   => $message,
                'mm_message'   => $mm_message,
                'data'      => $result,
            ];

            return response()->json($response);  
        }
    }

    public function ongoingdonors(){
        $donors = Donor::with(['inventories' => function ($inventory) {
                $inventory->orderByRaw("count DESC")->first();
                }])->get();

        $now = Carbon::now();
        $todaydate = $now->toDateString();
        $donorids =[];

        foreach ($donors as $donor) {
            $inventories = Inventory::where('donor_id',$donor->id)->orderByRaw("count DESC")->get();

            if (!$inventories->isEmpty()) {
                $dod = Carbon::parse($inventories[0]->dod);
                $coming_dod = $dod->addMonths(2)->format('Y-m-d');

                    if ($coming_dod == $todaydate) {
                        $donorid = $donor->id;

                        array_push($donorids, $donorid);
                        // var_dump($donorid);
                    }
                

            }

            

            
        }

        if (count($donorids) < 0) {
            $data=null; 
        }else{
            $data = Donor::whereIn('id',$donorids)->get();

        }

        if (is_null($data)) {
            # 404
            $status = 404;
            $message = 'Donor not found.';
            $mm_message = 'အလှူရှင်အားရှာမတွေ့ပါ';


            $response = [
                'status'    => $status,
                'success'   => false,
                'message'   => $message,
                'mm_message'=> $mm_message
            ];

        }else{
            $result = InventoryResource::collection($data);

            $message = 'Donation retrieved successfully.';
            $mm_message = 'အလှူမှတ်တမ်းအားအောင်မြင်စွာထုတ်ယူပြီးပါပြီ';

            $status = 200;

            $response = [
                'status'    =>  $status,
                'success'   =>  true,
                'message'   =>  $message,
                'mm_message'   =>  $mm_message,
                'data'      =>  $result,
            ];
        }

        return response()->json($response);

    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
