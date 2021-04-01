<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Apiauthcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::guard('api')->check()) {
            return $next($request);
        }
        else{
            $status = 401;
            $message = 'User Not Logged In';
            $mm_message = 'အသုံးပြုသူသည် log in မ ၀င်ရသေးပါ';


            $response = [
                'status'    =>  $status,
                'success'   =>  false,
                'message'   =>  $message,
                'mm_message'   =>  $mm_message
            ]; 

            return response()->json($response); 
        }
    }
}
