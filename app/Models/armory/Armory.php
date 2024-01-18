<?php

namespace App\Models\armory;

use App\Models\rule\Rule;
use App\Models\weapons\Ammunition;
use App\Models\weapons\WeaponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armory extends Model
{
    use HasFactory;
    protected $keyType = 'string';


    public static function getSingle($id)
    {
        return self::find($id);
    }

    public function weaponTypes()
    {
        return $this->hasMany(WeaponType::class);
    }

    public function ammunition()
    {
        return $this->hasMany(Ammunition::class);
    }
}
