<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OauthToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:5'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => [
                    'code' => 400,
                    'response' => 'error',
                    'message' => 'Please fill the blank fields.'
                ],
                'result' => [],
                'validation_errors' => $validator->errors()
            ]);
        }
  
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
  
        if(!is_null($user)) {
            $token = $user->createToken('token')->accessToken;
            $userToken = OauthToken::create([
                'user_id' => $user->id,
                'access_token' => $token
            ]);
            
            return response()->json([
                'status' => [
                    'code' => 201,
                    'response' => 'success',
                    'message' => 'Register new user successfully.'
                ],
                'result' => $user
            ]);
        } else {
            return response()->json([
                'status' => [
                    'code' => 409,
                    'response' => 'failed',
                    'message' => 'Register new user failed. Please try again.'
                ],
                'result' => []
            ]);
        }
    }
}