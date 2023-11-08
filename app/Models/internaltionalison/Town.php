<?php

namespace App\Models\internaltionalison;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    public function state(){
        return $this->belongsTo(State::class,'state_id');

    }

}
