<?php

namespace App\Models\internaltionalison;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
