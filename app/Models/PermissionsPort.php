<?php

namespace App\Models;

use App\Models\armory\HoldersWeapon;
use App\Models\weapons\Weapon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsPort extends Model
{
    use HasFactory;
    protected $keyType = 'string';

    protected $fillable = ['statut', 'code_finac', 'numero_serie', 'validate_from_id', 'prefix'];

    public function holderWeapons()
    {
        return $this->belongsTo(HoldersWeapon::class, 'holder_id', 'id');
    }

    public function weapon()
    {
        return $this->belongsTo(Weapon::class, 'weapon_id', 'id');
    }
}
