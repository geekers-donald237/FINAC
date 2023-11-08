<?php

namespace App\Models\internaltionalison;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public function country(){
        return $this->belongsTo(Country::class,'country_id');

    }
    public function towns(){
        return $this->hasMany(Town::class,'state_id');

    }
}
