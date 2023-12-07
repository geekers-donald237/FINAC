<?php

namespace App\Models\user\subAdmin;

use App\Models\internaltionalison\Country;
use App\Models\internaltionalison\Departement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefect extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

}
