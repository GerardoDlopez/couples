<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Mail\WelcomeMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function CreateUser(CreateuserRequest $request):JsonResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($user->email)->send(new WelcomeMail($user->name));

        return response()->json([
            'status'=> 'true',
            'message' => 'User create succesfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    public function LoginUser(LoginRequest $request):JsonResponse
    {
        if(!Auth::attempt($request->only(['email','password']))){
            return response()->Json([
                'status' => false,
                'message' => 'email & password do not match wirh our records'
            ], 401);
        }

        $user = User::where('email',$request->email)->first();
        
        return response()->Json([
            'status' => true,
            'message' => 'User logged in successfully',
            'token'=> $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }
}
