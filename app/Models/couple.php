<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class couple extends Model
{
    use HasFactory;
    protected $fillable = [
        'user1_id',
        'user2_id',
    ];

    public function user1(){
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2(){
        return $this->belongsTo(User::class,'user2_id');
    }
}
