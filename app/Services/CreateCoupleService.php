<?php

namespace App\Services;
use App\Models\User;
use App\Models\Couple;
class CreateCoupleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
       
    }

    public function ValidateUsers(User $user, string $connectionToken): Couple
    {
        $user2 = User::where('connection_token', $connectionToken)->first();

        if (!$user2) {
            throw new \Exception('Usuario no encontrado');
        }

        if ($user->id === $user2->id) {
            throw new \Exception('No puedes conectarte contigo mismo');
        }

        // Verificar si ya existe una relación entre estos usuarios
        $existingCouple = Couple::where(function($query) use ($user, $user2) {
            $query->where('user1_id', $user->id)
                  ->where('user2_id', $user2->id);
        })->orWhere(function($query) use ($user, $user2) {
            $query->where('user1_id', $user2->id)
                  ->where('user2_id', $user->id);
        })->first();

        if ($existingCouple) {
            throw new \Exception('La relación ya existe');
        }

        // Crear la pareja
        $couple = Couple::create([
            'user1_id' => $user->id,
            'user2_id' => $user2->id,
        ]);

        // Anular los tokens de conexión
        $user->update(['connection_token' => null]);
        $user2->update(['connection_token' => null]);

        return $couple;
    }
}
