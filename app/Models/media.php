<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\couple;

class media extends Model
{
    use HasFactory;
    protected $table ='medias';
    protected $guarded = [];

    public function couple(){
        return $this->belongsTo(couple::class,'couple_id');
    }
}
