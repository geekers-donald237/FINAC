<?php

namespace App\Models\user\subAdmin;

use App\Models\internaltionalison\Country;
use App\Models\internaltionalison\Departement;
use App\Models\internaltionalison\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governor extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

}
