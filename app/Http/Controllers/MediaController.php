<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Models\media;
use App\Models\User;
use App\Services\CoupleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    protected $CoupleService;
    public function __construct(CoupleService $coupleService)
    {
        $this->CoupleService = $coupleService;
    }

    public function store(MediaRequest $request){
        $user = Auth::user();
        
        $couple_id = $this->CoupleService->getCoupleIdForUser($user->id);

        $media = media::create([
            'name' => $request->name,
            'couple_id' => $couple_id,
            'status' => $request->status ?? null,
            'trailer' => $request->trailer ?? null,
        ]);

        return response()->json([
            'status' => 'true',
            'messaje' => 'Pelicula/serie agregada exitosamente!',
            'media' => $media
        ], 200);
    }

    public function show(string $id){
        
        $media = media::where('couple_id', $id)->get();

        return response()->json([
            'status' => 'true',
            'media' => $media
        ], 200);
    }

    public function destroy(string $id){
        $media = media::find($id);
        $media->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'Pelicula/serie a sido eliminada con exito'
        ], 200);
    }
}
