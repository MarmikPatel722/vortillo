<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{   

    
    public function login(Request $request){

        $validator = \Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(),'status' => 0]);
        }

        $user = User::where('email', $request->email)
                  ->where('pass',md5($request->password))
                  ->first();

        if($user){
            
            $user_login_token = $user->createToken('PassportExample@Section.io')->accessToken;

            return response()->json(['token' => $user_login_token], 200);
        }
        else{

            
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }


    public function logout(Request $request)
    {         
        if($request->user())
        {
            $request->user()->token()->revoke();           

            return response()->json(['message' => 'Successfully logged out'], 200);
        }

        return response()->json(['error' => 'User not found'], 401);
    }


    
    public function user_details(Request $request){

        if($request->user())
        {
            $id = auth()->user()->person_id;

            $user = User::with('person','person_address')->where('person_id',$id)->first();
            
            return response()->json(['authenticated-user' => $user], 200);
        }
        return response()->json(['error' => 'User not found'], 401);
    }
}