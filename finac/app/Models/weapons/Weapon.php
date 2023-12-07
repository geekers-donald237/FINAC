<?php

namespace App\Models\weapons;

use App\Models\armory\HoldersWeapon;
use App\Models\PermissionsPort;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weapon extends Model
{
    use HasFactory;
    protected $keyType = 'string';



    public function permissionsPort()
    {
        return $this->hasMany(PermissionsPort::class, 'weapon_id', 'id');
    }

    public function weaponType()
    {
        return $this->belongsTo(WeaponType::class, 'weapon_type_id');
    }

    public function holders()
    {
        return $this->hasMany(HoldersWeapon::class);
    }

}
