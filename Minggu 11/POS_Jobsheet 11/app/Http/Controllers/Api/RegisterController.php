<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    public function __invoke(request $request){

        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255|unique:m_user',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'level_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('images', 'public');
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Image upload failed'
            ], 422);
        }

        //create user
        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
            'image' => $image->hashName(),
        ]);

        if($user){
            return response()->json([
                'success' => 'true',
                'user' => $user
            ], 201);
    }
    return response()->json([
        'success' => 'false',
        'message' => 'User registration failed'
    ], 500);
    }
}
