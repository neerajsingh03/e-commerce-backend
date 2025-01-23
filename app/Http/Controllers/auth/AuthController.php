<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Hash;
use Auth;
class AuthController extends Controller
{
    public function signUp(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',       
            // 'last_name'  => 'required|string|max:255',      
            'phone'      => 'required|string|max:15|unique:users',  
            'address'    => 'required|string|max:500',       
            'email'      => 'required|email|unique:users,email|max:255',  
            'password'   => 'required|string|min:6|',
            'city'       => 'required|string|max:500',   
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
       $user = new User;
       $user->first_name = $request->firstName;
       $user->last_name = $request->lastName;
       $user->phone = $request->phone;
       $user->address = $request->address;
       $user->city = $request->city;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->role = 'user';
       $user->save();
       $token = $user->createToken('auth_token')->plainTextToken;
       return response()->json([
        'success' => 'registration successfully',
        'role'    => $user->role,
        'token'   => $token,
       ],200);
    }
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password'  =>  'required',
           ]);
           if($validate->fails()){
                return response()->json([
                   'success' => false,
                   'message' => 'validation error',
                   'error'  =>  $validate->errors(),
                ],422);
           };
           $credential = $request->only('email','password');
           if(!Auth::attempt($credential)){
             return response()->json(['message' => 'Invalid login details'],401);
           }
           $user = Auth::user();
           $token = $user->createToken('login_token')->plainTextToken;
           return response()->json(['message' => 'Login successfully','token' =>$token,'role' => $user->role,'userId' =>$user->id]);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user->tokens()->delete();
        return response()->json(['success' => 'Logout successfully','status' => 200], 200);
    }
}
