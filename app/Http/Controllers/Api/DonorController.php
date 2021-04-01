<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\DonorResource;

use App\Models\Donor;
use App\Models\Blood;
use App\Models\User;

use Validator;
use Carbon\Carbon;

use Auth;

class DonorController extends Controller
{

    public function index()
    {
        
        $donors = Donor::paginate();
        $result = DonorResource::collection($donors);

        $message = 'Donor retrieved successfully.';
        $mm_message = 'အလှူရှင်များအားအောင်မြင်စွာထုတ်ယူပြီးပါပြီ';

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
            'phone'     => 'required',
            'blood'     => 'required',
            'address'     => 'required',

            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ];

        $customMessages = [
            'phone.required' => 'ဖုန်းနံပါတ်ဖြည့်သွင်းရန်လိုအပ်ပါသည်။',
            'blood.required' => 'သွေးလှူဒါန်းသူ၏သွေးအမျိုးအစားသိမ်းထားရန်လိုအပ်ပါသည်။',
            'address.required' => 'နေရပ်လိပ်စာဖြည့်သွင်းရန်လိုအပ်ပါသည်။',

            'name.required' => 'သွေးလှူဒါန်းသူ၏နာမည်လိုအပ်ပါသည်။',
            'name.max' => 'နာမည်မှာ သတ်မှတ်ထားသောအရေအတွက်ထက်ကျော်လွန်နေပါသည်။',

            'email.required' => 'အီးမေးလ်လိုအပ်ပါသည်။',
            'email.max' => 'အီးမေးလ်မှာသတ်မှတ်ထားသောအရေအတွက်ထက်ကျော်လွန်နေပါသည်။',
            'email.unique' => 'အီးမေးလ်မှာထပ်နေသည်',

            'password.required' => 'စကားဝှက်လိုအပ်ပါသည်။',
            'password.min' => 'စကားဝှက်မှာအနည်းဆုံးစာလုံး ၈ လုံးပါရမည်။'

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
            $name = $request->name;
            $dob = $request->dob;
            $email = $request->email;
            $password = $request->password;
            $phone = $request->phone;
            $blood = $request->blood;
            $address = $request->address;

            // $authuser = Auth::user();
            // $authuser_id = Auth::id();

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();

            $user->assignRole('Donor');

            $donor = new Donor();
            $donor->dob = $dob;
            $donor->phone = $phone;
            $donor->address = $address;
            $donor->blood_id = $blood;
            $donor->user_id = $user->id;
            $donor->created_id = 1;
            $donor->save();

            $status = 201;
            $message = 'Donor created successfully.';
            $mm_message = 'အလှူရှင်အားအောင်မြင်စွာထုတ်ယူပြီးပါပြီ';
            $result = new DonorResource($donor);

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

    public function show($id)
    {
        $donor = Donor::find($id);

        if (is_null($donor)) {
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

            return response()->json($response);
        }else{
            #200
            $status = 200;
            $message = 'Donor retrieved successfully.';
            $mm_message = 'အလှူရှင်အားအောင်မြင်စွာထုတ်ယူပြီးပါပြီ';

            $result = new DonorResource($donor);

            $response = [
                'status'    =>  $status,
                'success'   =>  true,
                'message'   =>  $message,
                'mm_message'=>  $mm_message,
                'data'      =>  $result
            ];

            return response()->json($response);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'phone'     => 'required',
            'blood'     => 'required',
            'address'     => 'required',

            'name' => ['required'],
        ];

        $customMessages = [
            'phone.required' => 'ဖုန်းနံပါတ်ဖြည့်သွင်းရန်လိုအပ်ပါသည်။',
            'blood.required' => 'သွေးလှူဒါန်းသူ၏သွေးအမျိုးအစားသိမ်းထားရန်လိုအပ်ပါသည်။',
            'address.required' => 'နေရပ်လိပ်စာဖြည့်သွင်းရန်လိုအပ်ပါသည်။',

            'name.required' => 'သွေးလှူဒါန်းသူ၏နာမည်လိုအပ်ပါသည်။',

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
            $name = $request->name;
            $dob = $request->dob;
            $phone = $request->phone;
            $blood = $request->blood;
            $address = $request->address;

            // $authuser = Auth::user();
            // $authuser_id = Auth::id();

            $donor = Donor::find($id);
            $donor->dob = $dob;
            $donor->phone = $phone;
            $donor->address = $address;
            $donor->blood_id = $blood;
            $donor->created_id = 1;
            $donor->save();

            $donor_user = $donor->user->id;

            $user = User::find($donor_user);
            $user->name = $name;
            $user->save();

            $status = 204;
            $message = 'Donor update successfully.';
            $mm_message = 'အလှူရှင်အားအောင်မြင်စွာပြင်ဆင်ပြီးပါပြီ';
            $result = new DonorResource($donor);

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

    public function destroy($id)
    {
        $donor = Donor::find($id);

        if (is_null($donor)) {
            # 404
            $status = 404;
            $message = 'Donor not found.';
            $mm_message = 'အလှူရှင်ရှာမတွေ့ပါ';


            $response = [
                'status'    => $status,
                'success'   => false,
                'message'   => $message,
                'mm_message'=> $mm_message
            ];

            return response()->json($response);
        }else{
            $donor->delete();

            #200
            $status = 204;
            $message = 'Donor deleted successfully.';
            $mm_message = 'အလှူရှင်အားအောင်မြင်စွာဖျက်ပြီးပါပြီ';

            $response = [
                'status'    =>  $status,
                'success'   =>  true,
                'message'   =>  $message,
                'mm_message'=>  $mm_message,
            ];

            return response()->json($response);
        }
    }
}
