<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
    	return view('login');
    }

    public function login(Request $request){
    	$rules = [
            'email'     => 'required',
            'password'  => 'required|min:8'
        ];

        $customMessages = [
	        'email.required' => 'အီးမေးလ်လိုအပ်ပါသည်။',
	        'password.required' => 'စကားဝှက်လိုအပ်ပါသည်။',
	        'password.min' => 'စကားဝှက်မှာအနည်းဆုံးစာလုံး ၈ လုံးပါရမည်။'

	    ];

	    $this->validate($request, $rules, $customMessages);

    	$email = $request->email;
    	$password = Hash::make($request->password);

    	$user= User::where('email', '=', $email)->first();

    	if ($user) {
            $role = $user->getRoleNames();

    		if (Hash::check($request->password, $user->password)) {

                if ($role[0] == 'Admin') {
                    $credentials = $request->only('email', 'password');
                    Auth::attempt($credentials);

                    return \Redirect::route('home'); 
                }

    			else{
                    return redirect()->back()->with('message','ဒီအကောင့်ကိုကျွန်ုပ်တို့မသိခဲ့ပါ အခြားအကောင့်တစ်ခုရိုက်ထည့်ပါ');
                }      				

    		}
    		else{
				return redirect()->back()->with('message','စကားဝှက်မှားယွင်းနေပါသည်။');
			}
    	}
    	else{
    		return redirect()->back()->with('message','ဒီအကောင့်ကိုကျွန်ုပ်တို့မသိခဲ့ပါ အခြားအကောင့်တစ်ခုရိုက်ထည့်ပါ');
    	}
    }
}
