<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Models\media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function store(MediaRequest $request){

        $media = media::create([
            'name' => $request->name,
            'couple_id' => $request->couple_id
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
