<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\UserResource;

use App\Models\User;
use Auth;
use Validator;
use Carbon\Carbon;

class LoginController extends Controller
{
	public function authuser(Request $request){
    	return Auth::guard('api')->user();
	}

    public function login(Request $request)
    {
    	$rules = [
            'email'     => 'required',
            'password'  => 'required|min:8'
        ];

        $customMessages = [
	        'email.required' => 'အီးမေးလ်လိုအပ်ပါသည်။',
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

        }
        else{
        	$email = $request->email;
    		$password = Hash::make($request->password);

	    	$user= User::where('email', '=', $email)->first();
	    	if ($user) {
	    		if (Hash::check($request->password, $user->password)) {


	                $tokenResult = $user->createToken('Personal Access Token');
			        $token = $tokenResult->token;
			        if ($request->remember_me)
			        {

			            $token->expires_at = Carbon::now()->addWeeks(1);
			        	$token->save();

			        }

		            $message = 'User login successfully.';
		            $mm_message = 'အသုံးပြုသူအောင်မြင်စွာဝင်ရောက်သည်။';
			        $status = 200;
			        $result = new UserResource($user);

			        $response = [
			            'status'  => $status,
			            'success' => true,
			            'data'    => $result,
			            'token'	  => $tokenResult->accessToken,
			            'token_type' => 'Bearer',
			            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
			            'message' => $message,
			            'mm_message' => $mm_message,
            			'data'      =>  $result,

			        ];      				

	    		}
	    		else{
	    			$status = 401;
		            $message = 'Wrong Password';
		            $mm_message = 'စကားဝှက်မှားယွင်းနေပါသည်။';


		            $response = [
		                'status'    =>  $status,
		                'success'   =>  false,
		                'message'   =>  $message,
		                'mm_message'   =>  $mm_message
		            ];
				}
	    	}
	    	else{
	    		$status = 401;
	            $message = 'User Unauthorised';
	            $mm_message = 'ဒီအကောင့်ကိုကျွန်ုပ်တို့မသိခဲ့ပါ အခြားအကောင့်တစ်ခုရိုက်ထည့်ပါ';


	            $response = [
	                'status'    =>  $status,
	                'success'   =>  false,
	                'message'   =>  $message,
	                'mm_message'   =>  $mm_message
	            ];	            
	    	}

        }

        return response()->json($response);   
    }  

    public function logout(Request $request)
    {
        Auth::guard('api')->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    } 
}
