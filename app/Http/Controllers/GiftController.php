<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftRequest;
use App\Http\Requests\UpdateGiftRequest;
use App\Models\gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $gifts = $user->gifts()->get();

        return response()->json([
            'gifts' => $gifts
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GiftRequest $request)
    {
        $giftData = $request->validated();
        
        $giftData['user_id'] = Auth::id();
        
        $gift = gift::create($giftData);

        return response()->json([
            'status' => 'true',
            'message' => 'Gift creado satisfactoriamente!!',
            'gift' => $gift
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGiftRequest $request, string $id)
    {
        $gift = gift::findOrFail($id);
        
        // Obtén los datos validados, ahora sin necesidad de añadir user_id
        $giftData = $request->validated();

        // Actualiza el regalo con los datos validados
        $gift->update($giftData);
    
        return response()->json([
            'status' => 'true',
            'message' => 'Regalo '.$gift->name. ' actualizado satisfactoriamente!!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gift = gift::find($id);

        $gift->delete();

        return response()->json([
            'status' => 'true',
            'message' => 'Regalo eliminado'
        ],204);
    }
}
