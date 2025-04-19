<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Hash;
 use App\Models\UserModel;
 class AuthController extends Controller
 {  
    public function home(){
        return view('home');
    }
     public function login()
     {
         if (Auth::check()) {
             return redirect('/');
         }
         return view('auth.login');
     }
 
     public function postlogin(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $credentials = $request->only('username', 'password');
 
             if (Auth::attempt($credentials)) {
                 return response()->json([
                     'status' => true,
                     'message' => 'Login Berhasil',
                     'redirect' => url('/'),
                 ]);
             }
 
             return response()->json([
                 'status' => false,
                 'message' => 'Login Gagal',
             ]);
         }
 
         return redirect('login');
     }
 
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect('home');
     }

     public function showRegistrationForm()
     {
         return view('auth.register');
     }
 
     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'username' => 'required|string|max:255|unique:m_user',
             'nama' => 'required|string|max:255',
             'password' => 'required|string|min:6|confirmed',
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
 
         $user = UserModel::create([
             'username' => $request->username,
             'nama' => $request->nama,
             'password' => Hash::make($request->password),
             'level_id' => 5, // Level ID Customer
         ]);
 
         Auth::login($user);
 
         return redirect('/')->with('success', 'Registrasi berhasil!');
     }
 }