<?php

namespace App\Models\armory;

use App\Models\PermissionsPort;
use App\Models\weapons\Weapon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoldersWeapon extends Model
{
    use HasFactory;
    protected $keyType = 'string';


    public function permissionsPort()
    {
        return $this->hasMany(PermissionsPort::class, 'holder_id', 'id');
    }

    public function weapon()
    {
        return $this->belongsTo(Weapon::class, 'weapon_id');
    }


}
