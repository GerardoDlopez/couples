<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoupleRequest;
use App\Models\couple;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\ConnectionUserRequest;
use App\Services\CreateCoupleService;

class CoupleController extends Controller
{

    protected $CreateCoupleService;

    public function __construct(CreateCoupleService $CreateCoupleService)
    {
        $this->CreateCoupleService = $CreateCoupleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(7);
        $couple = $user->couple;
        return response()->json($couple);
    }

    public function CreateTokenUser(Request $request):JsonResponse
    {
        $user = Auth::user();
        User::where('email', $user->email)->update([
            'connection_token' => Str::random(32),
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'token creado',
            'token' => $user->connection_token
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConnectionUserRequest $request):JsonResponse
    {
        $user = Auth::user();

        try {
            $couple = $this->CreateCoupleService->ValidateUsers($user, $request->connection_token);

            return response()->json([
                'status' => 'true',
                'message' => 'Pareja creada correctamente',
                'couple' => $couple
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'false',
                'message' => $e->getMessage()
            ], 400);
        }

    }

    public function show(string $id)
    {
        $couple = couple::with(['user1','user2'])->find($id)->get();

        if(!$couple){       
            return response()->json([
                'status' => 'false',
                'message' => 'pareja no encontrada'
            ], 404);
            
        }

        return response()->json([
            'status' => 'true',
            'message' => 'pareja encontrada!',
            'couple' => $couple
        ], 200);
    }
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $couple = $user->couple()->first();
        $couple->delete();
        
        return response()->json([
            'status' => 'true',
            'message' => 'Pareja eliminada correctamente'
        ], 200);
    }
}
