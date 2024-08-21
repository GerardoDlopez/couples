<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function CreateUser(CreateuserRequest $request):JsonResponse
    {

        $user = User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status'=> 'true',
            'message' => 'Usuario creado exitosamente!',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    public function LoginUser(LoginRequest $request):JsonResponse
    {
        if(!Auth::attempt($request->only(['email','password']))){
            return response()->Json([
                'status' => false,
                'message' => 'Correo y contraseña invalidos'
            ], 401);
        }

        $user = User::where('email',$request->email)->first();
        
        return response()->Json([
            'status' => true,
            'message' => 'Inicio de sesion exitoso',
            'token'=> $user->createToken('API TOKEN')->plainTextToken
        ],200);
    }

    public function LogOutUser(Request $request){
         
        Auth::user()->currentAccessToken()->delete();

        return response()->Json([
            'status' => true,
            'message' => 'Cierre de sesión exitoso'
        ],200);
    }
}
