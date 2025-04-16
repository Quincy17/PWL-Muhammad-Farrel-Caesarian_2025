<?php
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 
 class LoginController
 {
     public function login(Request $request)
     {
         $credentials = $request->only('username', 'password');
 
         if (Auth::attempt($credentials)) {
             return response()->json([
                 'status' => true,
                 'message' => 'Login berhasil!',
                 'redirect' => url('/home')
             ]);
         }
 
         return response()->json([
             'status' => false,
             'message' => 'Username atau password salah!'
         ]);
     }
 }