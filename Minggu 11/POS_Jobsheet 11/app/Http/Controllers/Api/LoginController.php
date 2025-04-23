<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('username', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)){
            return response()->json([
                'success' => 'false',
                'message' => 'Username atau Password anda salah'
            ], 401);
        }

        return response()->json([
            'success' => 'true',
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 200);
    }
}
