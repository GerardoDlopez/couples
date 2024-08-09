<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\userUpdateRequest;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('name','email')->get();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateuserRequest $request):JsonResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status'=> 'true',
            'message' => 'User create succesfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(userUpdateRequest $request, string $id):JsonResponse
    {
        $user = User::find($id);
        if($request->name){
            $user -> name = $request->name;
        }

        if($request->email){
            $user->email = $request->email;
        }
                
        if($request->password){
            $user->password = $request->password;
        }

        $user->update();

        return response()->json($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
