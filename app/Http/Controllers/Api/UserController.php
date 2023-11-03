<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            "status" => 'Ok',
            "status_code" => 200,
            "message" => "User Created"
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

       $user = User::where("email", "=", $request->email)->first();

       if( isset($user->id )){
          if( Hash::check($request->password, $user->password)){
            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json([
                "status" => 'Ok',
                "status_code" => 200,
                "message" => "authenticated user",
                "access_token" => $token
              ]);
          }else{
            return response()->json([
                "status" => 'Error',
                "message" => "Incorrect password",
              ], 404);
          }
       }else{
          return response()->json([
                "status" => 'Error',
                "message" => "Incorrect User",
          ], 404);
       }
    }

    public function home(){
        return response()->json([
            "status" => 'Ok',
            "status_code" => 200,
            "message" => "Data Home",
            "data" => auth()->user()
          ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => "Ok",
            "status_code" => 200,
            "message" => "Session Ended",
            
          ]);
    }
}
